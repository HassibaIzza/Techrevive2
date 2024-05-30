<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Typepanne;
use App\Models\Typep;
use Illuminate\Support\Facades\Auth;



class PannesController extends Controller
{

    public function pannesAdd(){
        $pannes = Typep::all();
        return view('backend.pannes.pannes_add', compact('pannes'));
    }

    public function store(Request  $request)
{
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'typep_id' => 'required|numeric|exists:typeps,id', // Assuming this is not a foreign key but still needs validation

        ]);

        if (!Auth::check()) {
            return redirect('login')->withErrors('Vous devez être connecté pour effectuer cette action.');
        }

        try{
            $panne = new Typepanne([
                'name' => $request->name,
                'typep_id' => $request->typep_id,
                'user_id' => Auth::id(),
            ]);
            $panne->save();
            return redirect()->back()->with('success', 'Panne enregistrée avec succès !');
        }catch(\Exception $e){
            return redirect()->back()->withErrors('Erreur lors de l\'enregistrement : ' . $e->getMessage());
        }
}
}
