<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

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

    public function showSeatSelection($scheduleId)
    {
        $schedule = Schedule::with(['bus', 'route'])->findOrFail($scheduleId);
        $bookedSeats = Booking::where('schedule_id', $scheduleId)
            ->where('status', 'confirmed')
            ->pluck('seat_number')
            ->toArray();

        return view('seatselect', compact('schedule', 'bookedSeats'));
    }

    public function showReservation($scheduleId)
    {
        if (!session('selected_seats')) {
            return redirect()->route('booking.seats', $scheduleId)
                ->with('error', 'Please select seats first');
        }

        $schedule = Schedule::with(['bus', 'route'])->findOrFail($scheduleId);
        $selectedSeats = session('selected_seats');

        return view('reservation', compact('schedule', 'selectedSeats'));
    }

    public function storeSelectedSeats(Request $request, $scheduleId)
    {
        $request->validate([
            'seats' => 'required|array|min:1'
        ]);

        session(['selected_seats' => $request->seats]);

        return response()->json([
            'success' => true,
            'redirect' => route('booking.reservation', $scheduleId)
        ]);
    }
}
