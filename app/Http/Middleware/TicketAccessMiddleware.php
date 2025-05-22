<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TicketAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ticketId = $request->route('id');
        $ticket = \App\Models\Ticket::find($ticketId);

        if (!$ticket || $ticket->user_id !== session('user_id')) {
            return redirect()->route('mybooking')
                ->with('error', 'You do not have access to this ticket.');
        }

        return $next($request);
    }
}
