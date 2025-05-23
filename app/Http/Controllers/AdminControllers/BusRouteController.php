<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\BusRoute;  // Updated from BusRote
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BusRouteController extends Controller
{
    public function addRoute(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'from' => 'required|string|max:255',
                'to' => 'required|string|max:255',
                'distance' => 'required|numeric',
                'status' => 'required',
                'routeImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Remove duration validation - it's now optional
            ]);

            // Set default empty value for duration if not provided
            $validatedData['duration'] = $request->input('duration', '');

            // Convert status to boolean
            $validatedData['status'] = $validatedData['status'] == '1';

            // Handle image upload
            if ($request->hasFile('routeImage')) {
                $image = $request->file('routeImage');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('route-images', $filename, 'public');
                $validatedData['routeImage'] = $path;
            }

            $route = BusRoute::create($validatedData);  // Updated from BusRote

            return response()->json([
                'success' => true,
                'route' => $route,
                'message' => 'Route added successfully'
            ]);
        } catch(\Exception $e) {
            Log::error('Route creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error adding route: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showRoute(Request $request)
    {
        try {
            $routes = BusRoute::latest()->get()->map(function($route) {  // Updated from BusRote
                return [
                    'id' => $route->id,
                    'from' => $route->from,
                    'to' => $route->to,
                    'distance' => $route->distance,
                    'duration' => $route->duration,
                    'status' => $route->status ? 'active' : 'inactive',
                    'image' => $route->routeImage
                ];
            });

            return view('AdminViews.mainpage', [
                'routes' => $routes,
                'activeSection' => 'routes'
            ]);
        } catch(\Exception $e) {
            Log::error('Error fetching routes: ' . $e->getMessage());
            return view('AdminViews.mainpage', [
                'routes' => [],
                'activeSection' => 'routes'
            ]);
        }
    }

    public function deleteRoute($id)
    {
        try {
            $route = BusRoute::findOrFail($id);

            // Delete route image if exists
            if ($route->routeImage && Storage::disk('public')->exists($route->routeImage)) {
                Storage::disk('public')->delete($route->routeImage);
            }

            $route->delete();

            return response()->json([
                'success' => true,
                'message' => 'Route deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Route deletion failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting route: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateRoute(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'from' => 'required|string|max:255',
                'to' => 'required|string|max:255',
                'distance' => 'required|numeric',
                'status' => 'required|in:0,1',
                'routeImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Remove duration validation - it's now optional
            ]);

            // Set duration from request or keep existing
            $validatedData['duration'] = $request->input('duration', '');

            $route = BusRoute::findOrFail($id);

            // Convert status to boolean
            $validatedData['status'] = $validatedData['status'] == '1';

            // Handle image upload
            if ($request->hasFile('routeImage')) {
                // Delete old image if exists
                if ($route->routeImage && Storage::disk('public')->exists($route->routeImage)) {
                    Storage::disk('public')->delete($route->routeImage);
                }

                $image = $request->file('routeImage');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('route-images', $filename, 'public');
                $validatedData['routeImage'] = $path;
            }

            $route->update($validatedData);

            $updatedRoute = [
                'id' => $route->id,
                'from' => $route->from,
                'to' => $route->to,
                'distance' => $route->distance,
                'duration' => $route->duration,
                'status' => $route->status ? 'active' : 'inactive',
                'image' => $route->routeImage
            ];

            return response()->json([
                'success' => true,
                'route' => $updatedRoute,
                'message' => 'Route updated successfully'
            ]);
        } catch(\Exception $e) {
            Log::error('Route update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating route: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getRoutes()
    {
        try {
            $routes = BusRoute::select('id', 'from', 'to', 'distance', 'duration', 'status', 'routeImage')
                ->get()
                ->map(function($route) {
                    return [
                        'id' => $route->id,
                        'from' => $route->from,
                        'to' => $route->to,
                        'distance' => $route->distance,
                        'duration' => $route->duration,
                        'status' => $route->status ? 'active' : 'inactive',
                        'image' => $route->routeImage
                    ];
                });

            return response()->json([
                'success' => true,
                'routes' => $routes
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching routes: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching routes: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLocations()
    {
        try {
            $fromLocations = BusRoute::distinct()->pluck('from')->sort()->values();
            $toLocations = BusRoute::distinct()->pluck('to')->sort()->values();

            return response()->json([
                'success' => true,
                'fromLocations' => $fromLocations,
                'toLocations' => $toLocations
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching locations: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching locations: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getActiveRoutes()
    {
        try {
            Log::info('Fetching active routes'); // Debug log

            $routes = BusRoute::where('status', true)
                ->select('id', 'from', 'to', 'duration', 'distance')
                ->get()
                ->map(function($route) {
                    Log::info('Processing route:', ['route' => $route->toArray()]); // Debug log

                    return [
                        'id' => $route->id,
                        'from' => $route->from,
                        'to' => $route->to,
                        'duration' => $route->duration,
                        'distance' => $route->distance,
                        'display_name' => "{$route->from} to {$route->to} ({$route->duration})"
                    ];
                });

            Log::info('Active routes response:', ['routes' => $routes->toArray()]); // Debug log

            return response()->json([
                'success' => true,
                'routes' => $routes
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching active routes: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching routes'
            ], 500);
        }
    }

    public function getAvailableBuses($routeId)
    {
        try {
            // Get all buses that aren't scheduled for the given time slot
            $buses = Bus::with('standard')
                ->whereNotExists(function ($query) use ($routeId) {
                    $query->from('schedules')
                        ->whereColumn('schedules.bus_id', 'buses.id')
                        ->where('schedules.route_id', $routeId)
                        ->whereDate('schedules.departure_date', request('date', now()->toDateString()));
                })
                ->get();

            return response()->json([
                'success' => true,
                'buses' => $buses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching available buses: ' . $e->getMessage()
            ], 500);
        }
    }
}
