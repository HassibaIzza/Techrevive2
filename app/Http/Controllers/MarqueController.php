<?php

namespace App\Http\Controllers;
use App\Http\Requests\MarqueRequest;

use App\Http\Requests\Request;
use App\Models\Marque;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class MarqueController extends Controller
{
    /**
     * @param MarqueRequest $request
     */
    public function store(MarqueRequest $request)
{
    $marque = new Marque();
    $marque->name = $request->name;
    $marque->gmail = $request->gmail;
    $marque->owner_id = Auth::id();  // Attribuer l'ID de l'utilisateur connecté à owner_id    
    $marque->save();
    


    return redirect()->back()->with('success', 'Marque créée avec succès.');
}

public function show(){
    $user = Auth::user();

    // Récupère uniquement les marques de l'utilisateur connecté
    $marques = $user->marques;

    // Envoie les marques à la vue
    return view('backend.marque.marque_default', compact('marques'));
}

public function marqueUpdate(MarqueRequest $request){

    // validation
    $data = $request->validated();

    // get the current marque ( which being updated )
    try {
        $marque = Marque::findOrFail($request->get('id'));
    }catch (ModelNotFoundException $exception){
        return redirect()->route('marques')->with('error', 'Something went wrong, try again.');
    }    

    // update
    $updateData = [
        'name' => $data['name'],
        'gmail' => $data['gmail']
    ];

    if ($marque->update($updateData))
        return response(['msg' => 'Marque modifier avec succées.'], 200);
    else
        return redirect()->route('admin-brand')->with('error', 'un probléme et survenue Réesseyez.');
}

public function marqueRemove(MarqueRequest $request){
    try {
        $marque = Marque::findOrFail($request->id);
        
        if ($marque->delete())
            return redirect()->route('marques')->with('success', 'Successfully removed.');
        else
            return redirect('marques')->with('error', 'Failed to remove this brand.');
    }catch (ModelNotFoundException $exception){
        return redirect('marques')->with('error', 'Failed to remove this brand.');
    }
}
}
