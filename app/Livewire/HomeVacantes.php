<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    //Este atributo estará a la escucha cuando se mande a llamar a "terminosBusqueda" para que ejecute la funcion "buscar"
    protected $listeners = ['terminosBusqueda' => 'buscar'];

    public $termino;
    public $categoria;
    public $salario;

    public function buscar($termino, $categoria, $salario)
    {        
        // dd($categoria);
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;

    }
    
    public function render()
    {
        
        // $vacantes = Vacante::all();

        //Buscamos el termino con la función when
        //When solo se ejecuta si la variable ($this->termino) tiene contenido, es decir, que no sea null o false
        //De lo contrario es como si ejecutara $vacantes = Vacante::orderBy('created_at', 'DESC')->paginate(10);
        //Eso traeria todos los registros de 10 en 10

        $vacantes = Vacante::when($this->termino, function($query){
                $query->where('titulo', 'LIKE', '%'.$this->termino.'%');
            })->when($this->termino, function($query){
                $query->orwhere('empresa', 'LIKE', '%'.$this->termino.'%');
            })->when($this->categoria, function($query){
                $query->where('categoria_id', $this->categoria);
            })->when($this->salario, function($query){
                $query->where('salario_id', $this->salario);
            })->whereDate('ultimo_dia','>=',now())->orderBy('created_at', 'DESC')->paginate(10);


        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
