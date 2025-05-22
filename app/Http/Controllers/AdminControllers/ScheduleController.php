<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\BusRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function index()
    {
        try {
            $schedules = Schedule::with(['route', 'bus.standard'])->latest()->get()->map(function($schedule) {
                return [
                    'id' => $schedule->id,
                    'route' => $schedule->route->from . ' → ' . $schedule->route->to,
                    'route_id' => $schedule->route_id,
                    'bus_id' => $schedule->bus_id,
                    'busName' => $schedule->bus->name,
                    'busType' => $schedule->bus->standard->name,
                    'departureDate' => $schedule->departure_date->format('Y-m-d'),
                    'departureTime' => $schedule->departure_time->format('H:i'),
                    'duration' => $schedule->duration . ' hours',
                    'price' => $schedule->price,
                    'boardingPoint' => $schedule->boarding_point,
                    'status' => $schedule->status,
                    'delay' => $schedule->delay_minutes,
                    'foodBreak' => $schedule->food_break,
                    'reason' => $schedule->status_reason
                ];
            });

            $routes = BusRoute::all();
            $buses = Bus::with('standard')->get();

            return response()->json([
                'success' => true,
                'schedules' => $schedules,
                'routes' => $routes,
                'buses' => $buses
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching schedules: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching schedules'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'route_id' => 'required|exists:bus_routes,id',
                'bus_id' => 'required|exists:buses,id',
                'departure_date' => 'required|date',
                'departure_time' => 'required',
                'duration' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'boarding_point' => 'required|string',
                'food_break' => 'required|array',
                'food_break.location' => 'required|string',
                'food_break.time' => 'required',
                'food_break.duration' => 'required|integer|min:1'
            ]);

            $schedule = Schedule::create($validated);

            // Load the relationships for the response
            $schedule->load(['route', 'bus']);

            // Format the schedule data for the frontend
            $formattedSchedule = [
                'id' => $schedule->id,
                'route' => $schedule->route->from . ' → ' . $schedule->route->to,
                'busName' => $schedule->bus->name,
                'busType' => $schedule->bus->standard->name,
                'departureDate' => $schedule->departure_date->format('Y-m-d'),
                'departureTime' => $schedule->departure_time->format('H:i'),
                'duration' => $schedule->duration . ' hours',
                'price' => $schedule->price,
                'boardingPoint' => $schedule->boarding_point,
                'status' => 'upcoming',
                'delay' => 0,
                'foodBreak' => $schedule->food_break
            ];

            return response()->json([
                'success' => true,
                'message' => 'Schedule created successfully',
                'schedule' => $formattedSchedule
            ]);
        } catch (\Exception $e) {
            Log::error('Schedule creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating schedule: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Schedule $schedule)
    {
        try {
            $validated = $request->validate([
                'route_id' => 'required|exists:bus_routes,id',
                'bus_id' => 'required|exists:buses,id',
                'departure_date' => 'required|date',
                'departure_time' => 'required',
                'duration' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'boarding_point' => 'required|string',
                'food_break' => 'required|array'
            ]);

            $schedule->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Schedule updated successfully',
                'schedule' => $schedule
            ]);
        } catch (\Exception $e) {
            Log::error('Schedule update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating schedule'
            ], 500);
        }
    }

    public function updateStatus(Request $request, Schedule $schedule)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:upcoming,delayed,cancelled',
                'delay_minutes' => 'required_if:status,delayed|nullable|integer|min:0',
                'status_reason' => 'nullable|string' // Made reason optional for all statuses
            ]);

            // Set delay_minutes to 0 for non-delayed status
            if ($validated['status'] !== 'delayed') {
                $validated['delay_minutes'] = 0;
            }

            $schedule->update($validated);

            // Load relationships and format response
            $schedule->load(['route', 'bus.standard']);
            $formattedSchedule = [
                'id' => $schedule->id,
                'route' => $schedule->route->from . ' → ' . $schedule->route->to,
                'route_id' => $schedule->route_id,
                'bus_id' => $schedule->bus_id,
                'busName' => $schedule->bus->name,
                'busType' => $schedule->bus->standard->name,
                'departureDate' => $schedule->departure_date->format('Y-m-d'),
                'departureTime' => $schedule->departure_time->format('H:i'),
                'duration' => $schedule->duration . ' hours',
                'price' => $schedule->price,
                'boardingPoint' => $schedule->boarding_point,
                'status' => $schedule->status,
                'delay' => $schedule->delay_minutes,
                'reason' => $schedule->status_reason,
                'foodBreak' => $schedule->food_break
            ];

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'schedule' => $formattedSchedule
            ]);
        } catch (\Exception $e) {
            Log::error('Status update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Schedule deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Schedule deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting schedule'
            ], 500);
        }
    }

    public function searchSchedules(Request $request)
    {
        try {
            $fromLocation = $request->input('from');
            $toLocation = $request->input('to');
            $date = $request->input('date');

            $schedules = Schedule::with(['route', 'bus.standard'])
                ->whereHas('route', function($query) use ($fromLocation, $toLocation) {
                    if ($fromLocation) {
                        $query->where('from', $fromLocation);
                    }
                    if ($toLocation) {
                        $query->where('to', $toLocation);
                    }
                })
                ->when($date, function($query) use ($date) {
                    return $query->whereDate('departure_date', $date);
                })
                ->where('status', '!=', 'cancelled')
                ->get()
                ->map(function($schedule) {
                    return [
                        'id' => $schedule->id,
                        'route' => $schedule->route->from . ' → ' . $schedule->route->to,
                        'bus' => $schedule->bus->name,
                        'bus_type' => $schedule->bus->standard->name,
                        'departure_date' => $schedule->departure_date->format('Y-m-d'),
                        'departure_time' => $schedule->departure_time->format('H:i'),
                        'duration' => $schedule->duration,
                        'price' => $schedule->price,
                        'seats_available' => $schedule->bus->seats, // You might want to calculate actual available seats
                        'status' => $schedule->status
                    ];
                });

            $fromLocations = BusRoute::distinct('from')->pluck('from')->sort()->values();
            $toLocations = BusRoute::distinct('to')->pluck('to')->sort()->values();

            return view('search', [
                'schedules' => $schedules,
                'fromLocation' => $fromLocation,
                'toLocation' => $toLocation,
                'date' => $date,
                'fromLocations' => $fromLocations,
                'toLocations' => $toLocations
            ]);

        } catch (\Exception $e) {
            Log::error('Schedule search failed: ' . $e->getMessage());
            return view('search')->with('error', 'Error searching schedules');
        }
    }
}
