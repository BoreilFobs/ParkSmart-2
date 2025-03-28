<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();

        return Inertia::render('Reservations/Index', [
            'reservations' => $reservations,
        ]);
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
}
