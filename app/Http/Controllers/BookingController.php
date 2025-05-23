<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Add booking logic here
        // This will only be accessible to logged-in users
        // because of the middleware
    }

    public function index()
    {
        // Show user's bookings
        $bookings = Booking::where('user_id', session('user_id'))->get();
        return view('bookings.index', compact('bookings'));
    }

    public function showSeatSelection($id)
    {
        try {
            $schedule = Schedule::with(['bus.standard', 'route'])
                ->findOrFail($id);

            // Calculate arrival time
            $schedule->arrival_time = Carbon::parse($schedule->departure_time)
                ->addHours($schedule->duration)
                ->format('H:i');

            // Load bus features with names
            $features = [];
            if ($schedule->bus->features) {
                // Check if features is already an array
                $featureIds = is_array($schedule->bus->features) 
                    ? $schedule->bus->features 
                    : json_decode($schedule->bus->features, true) ?? [];
                
                if (!empty($featureIds)) {
                    $features = \App\Models\BusFeature::whereIn('id', $featureIds)
                        ->pluck('name')
                        ->toArray();
                }
            }
            $schedule->bus->feature_names = $features;

            return view('seatselect', compact('schedule'));
        } catch (\Exception $e) {
            Log::error('Error showing seat selection: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Schedule not found');
        }
    }

    public function showReservation($id)
    {
        try {
            $schedule = Schedule::with(['bus.standard', 'route'])
                ->findOrFail($id);

            return view('reservation', compact('schedule'));
        } catch (\Exception $e) {
            Log::error('Error showing reservation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Schedule not found');
        }
    }

    public function storeSelectedSeats(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'seats' => 'required|array|min:1'
            ]);

            // Store selected seats in session
            session(['selected_seats' => $validated['seats']]);

            return response()->json([
                'success' => true,
                'redirect' => route('booking.reservation', $id)
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing seats: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error storing selected seats'
            ], 500);
        }
    }

    public function completeBooking(Request $request)
    {
        // Add booking completion logic here
        // This will be implemented when we set up the payment system
    }

    public function generateTicket($bookingId)
    {
        $booking = Booking::with(['schedule', 'user'])->findOrFail($bookingId);

        if ($booking->user_id !== session('user_id')) {
            return redirect()->route('mybooking')
                ->with('error', 'Unauthorized access');
        }

        $ticket = Ticket::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'schedule_id' => $booking->schedule_id,
            'ticket_number' => 'TKT-' . strtoupper(uniqid()),
            'status' => 'active',
            'total_amount' => $booking->total_amount
        ]);

        return redirect()->route('ticket.show', $ticket->id)
            ->with('success', 'Ticket generated successfully');
    }

    public function showTicket($id)
    {
        $ticket = Ticket::with(['booking', 'user'])->findOrFail($id);
        return view('ticket', compact('ticket'));
    }
}
