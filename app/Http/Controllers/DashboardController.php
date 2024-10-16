<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        \Log::info('DashboardController index method called');
        
        $userId = Auth::id();
        $tickets = Ticket::where('user_id', $userId)->get() ?? collect();
    
        // Log tickets for debugging
        \Log::info($tickets);
    
        // Statistics
        $totalTickets = Ticket::where('user_id', $userId)->count();
        $openTickets = Ticket::where('user_id', $userId)->where('status', 'open')->count();
        $closedTickets = Ticket::where('user_id', $userId)->where('status', 'closed')->count();
    
        return view('dashboard', compact('tickets', 'totalTickets', 'openTickets', 'closedTickets'));
    }
    
}
