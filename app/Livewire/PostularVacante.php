<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    // Necesario importar para poder subir archivos desde livewire
    use WithFileUploads;

    // Esta variable recibe al cv para validarlo y posteriormente enviarlo al servidor
    public $cv;
    public $vacante;
        
    protected $rules=[
        'cv'=>'required|mimes:pdf'
    ];

    // Funcion mount recibe la vacante enviada desde crear-vacante.php
    public function mount(Vacante $vacante)
    {
        //Lo asignamos a $vacante global para que toda la clase tenga acceso a esa vacante
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        // validar que el usuario no haya postulado a la vacante YA LO HICE CON POLICY
        // if($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0)
        // {
        //     session()->flash('mensaje', 'Ya postulaste a esta vacante anteriormente');
        // }

        //Almacenar CV en el disco duro
        $cv = $this->cv->store('public/cv');

        //Obtenemos la ruta
        $datos['cv'] = str_replace('public/cv/','',$cv);
        
        //Crear el candidato a la vacante
        //El campo vacante_id se agrega automáticamente gracias a la relacion
        $this->vacante->candidatos()->create([
            'user_id'=>auth()->user()->id,            
            'cv'=>$datos['cv']
        ]);

        //Crear notificacion y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //Mostrar el usuario en mensaje de OK
        session()->flash('mensaje','Se envió correctamente tu información, mucha suerte');
        return redirect()->back();

    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
