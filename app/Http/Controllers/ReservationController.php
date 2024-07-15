<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return Reservation::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'child_id'     => 'required|exists:children,id',
            'event_id'     => 'required|exists:events,id',
            'request_type' => 'required|string',
        ]);

        $reservationType = ReservationType::where('type', $data['request_type'])->firstOrFail();

        Reservation::create([
            'child_id'            => $data['child_id'],
            'event_id'            => $data['event_id'],
            'reservation_type_id' => $reservationType->id,
        ]);

        return redirect()->route('events.show', $request->event_id)->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return $reservation;
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'child_id' => ['required', 'exists:children'],
            'event_id' => ['required', 'exists:events'],
        ]);

        $reservation->update($data);

        return $reservation;
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json();
    }
}
