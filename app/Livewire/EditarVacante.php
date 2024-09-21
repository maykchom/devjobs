<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditarVacante extends Component
{
    //Creamos un variable por cada campo del formulario de editar-vacante.blade.php para mostrar los datos de la base de datos
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $imagen;
    public $descripcion;
    //Guardará la ruta de la nueva imagen si es que llegan a subir una nueva
    public $imagen_nueva;

    //Necesario para poder subir archivos al servidor
    use WithFileUploads;

    // Reglas necesarias para editarVacante(), esto sirve para validar la información que se guardar al editar
    //'nulable' es una regla que permite que un campo quede vacio pero en caso de ser llanado, debe cumplir sus reglas establecidas
    protected $rules =[
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa'=>'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024'
    ];

    // Especificamos el modelo en el parámetro que viene de edit.blade.php (en este caso es vacante)
    public function mount(Vacante $vacante)
    {   
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        //Carbon sirve para formatear la fecha (aaaa-mm-dd) y de esa forma asignarse al control del formulario correctamente
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');        
        $this->imagen = $vacante->imagen;
        $this->descripcion = $vacante->descripcion;
    }

    public function editarVacante(){
        // Automaticamente toma las reglas del arreglo "rules"
        // $datos guarda automáticamente toda la información ingresada en el formulario
        // y esa misma información es la que se enviará a la base de datos
        $datos = $this->validate();

        //Verificar si hay una nueva imagen
        if ($this->imagen_nueva) {
            //Guardamos la imagen en el servidor
            $imagen = $this->imagen_nueva->store('public/vacantes');
            //Obtenemos su nombre y extención, luego lo guardamos como un elemento mas en el arreglo datos['imagen]
            $datos['imagen'] = str_replace('public/vacantes/','',$imagen);
        }

        //Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);
        // dd($vacante->id);

        //Asignar los valores        
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        //Guardamos la imagen si es que existe el elemento 'imagen' en el arreglo datos[], de lo contrario seguimos guardando la imagen anterior
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //Guardar la vacante
        $vacante->save();

        //Redireccionar
        session()->flash('mensaje', 'La vacante se actualizó correctamente');
        return redirect()->route('vacantes.index');

        
    }

    public function render()
    {
        // Cosultamos la base de datos a traves de un modelo para pasarle la informacion a editar-vacante.blade.php
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante',[
            'salarios'=>$salarios,
            'categorias'=>$categorias
        ]);
    }
}
