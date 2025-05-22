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
