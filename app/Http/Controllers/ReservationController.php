<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Slot;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        $slots = Slot::findOrFail(1);
        return Inertia::render('Dashboard', [
            'slots' => $slots,
            'reservations' => $reservations,
        ]);
    }
    public function editSlot(Request $request)
    {
        $spot = Slot::findOrFail(1);
        $validatedData = $request->validate([
            "number" => "required|integer|min:1"
        ]);

        $spot->update(['number' => $validatedData['number']]);

        return redirect()->back()->with('success', 'Slot updated successfully!');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plate' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'spot' => 'required|string',
            'total' => 'required|numeric',
        ]);

        Reservation::create($validatedData);

        return redirect('/')->with('success', 'Reservation created successfully!');
    }
    public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->delete();

    return response()->json(['success' => true, 'message' => 'Reservation deleted successfully!']);
}
}
