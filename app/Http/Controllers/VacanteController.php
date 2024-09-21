<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificamos que solo los reclutadores puedan ver sus vacantes creadas (dashboard)
        Gate::authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificamos que solo los reclutadores puedan ver la pantalla de crear vacantes
        Gate::authorize('viewAny', Vacante::class);
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        //
        return view('vacantes.show',[
            "vacante"=>$vacante
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {

        //usamo policy para verificar si el usuario actual es el dueño de la vacante para que pueda editarlo
        // $this->authorize('update', $vacante); NO FUNCIONA EN LARAVEL 11
        Gate::authorize('update', $vacante);
 
// The action is authorized...

        return view('vacantes.edit',[
            'vacante'=>$vacante
        ]);
    }
}
