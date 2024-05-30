<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json(['tickets' => $tickets]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json(['ticket' => $ticket]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid',
            'visit_date' => 'required|date',
            'ticket_count' => 'required|integer',
            'promo_code' => 'nullable|string',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $ticket = Ticket::create($request->all());
        return response()->json(['message' => 'Ticket created successfully', 'ticket' => $ticket]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'uuid',
            'visit_date' => 'date',
            'ticket_count' => 'integer',
            'promo_code' => 'string',
            'total_price' => 'numeric',
            'status' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Ticket updated successfully',
            'ticket' => $ticket,
        ]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}
