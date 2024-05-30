<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        return view('admin.dataTiket.dataPembeli.index', compact('tickets'));
    }
}
