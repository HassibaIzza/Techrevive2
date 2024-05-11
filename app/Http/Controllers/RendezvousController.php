<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RendezvousController extends Controller
{
    public function rendezvous()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date_rendezvous' => 'required',
            'short_description' => 'required',
        ]);

        $panne = new RendezVous();
        $panne->date_rendezvous = $validatedData['date_rendezvous'];
        $panne->short_description = $validatedData['short_description'];
        $panne->client_id = Auth::id();
        $panne->save();

        return redirect()->route('bookings.create')->with('success', 'Rendez-vous ajouté avec succès.');

    }
}
