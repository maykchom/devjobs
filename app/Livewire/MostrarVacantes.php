<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Gate;

class MostrarVacantes extends Component
{
    // FUNCION PARA EJECUTAR CODIGO POR EVENTO CLICK LLAMADO "PRUEBA" DEL ARCHIVO mostrar-vacantes.blade.php
    // Activamos la escucha del lanzamiento del evento 'prueba' del archivo mostrar-vacantes.blade.php
    //============================================================================================================
    // #[On('mostrarAlerta')] 
    // public function mostrarAlerta($id)
    // {
    //     dd($id);
    // }
    //============================================================================================================

    //Funcion que se ejecuta desde el script js de mostrar-vacantes.blade.php enviando el id de la vacante
    //Al recibir el id de la vacante ($vacanteId) si se le coloca antes que va a ser de tipo Vacante (que es un modelo)
    //Automáticamente lo asocia y busca el modelo correspondiente a ese id, 
    //entonces ya no traerá solo el id de la vacante sino todos los datos de esa vacante
    #[On('eliminarVacante')] 
    public function eliminarVacante(Vacante $vacanteId){

        //Lanzamos la policy de que nadie pueda borrar una vacante si no fué creada por el
        Gate::authorize('delete', $vacanteId);
        
        $vacanteId->delete();
    }

    public function render()
    {
        //Consultamos a la base de datos las vacantes que ha generado un usuario
        $vacantes= Vacante::where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.mostrar-vacantes',[
            'vacantes'=>$vacantes
        ]);
    }
}
