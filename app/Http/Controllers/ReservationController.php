<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
            'request_type' => 'required|string|exists:reservation_types,type',
        ]);

        // Convert the request type to the corresponding ID and remove the string value.
        $data['reservation_type_id'] = ReservationType::where('type', $data['request_type'])->first()->id;
        unset($data['request_type']);

        try {
            Reservation::create($data);
            flash()->success('Reservation created successfully.');

            return redirect()->route('events.show', ['event' => $data['event_id']])
                             ->with('success', 'Reservation created successfully.');
        } catch (ValidationException $e) {
            flash()->error($e->getMessage());

            return redirect()->route('events.show', ['event' => $data['event_id']])
                             ->withErrors($e->errors());
        }
    }

    public function show(Reservation $reservation)
    {
        return $reservation;
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'child_id'     => ['required', 'exists:children'],
            'event_id'     => ['required', 'exists:events'],
            'request_type' => ['required', 'string', 'exists:reservation_types,type'],
        ]);

        try {
            $reservation->update($data);
            flash()->success('Reservation updated successfully.');

            return redirect()->route('events.show', ['event' => $data['event_id']])
                             ->with('success', 'Reservation updated successfully.');
        } catch (ValidationException $e) {
            flash()->error($e->getMessage());

            return redirect()->route('events.show', ['event' => $data['event_id']])
                             ->withErrors($e->errors());
        }
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json();
    }
}
