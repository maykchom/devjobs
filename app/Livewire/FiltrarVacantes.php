<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    public function leerDatosFormulario()
    {
        // Comunicarnos con el componente padre (HomeVacante.php) a traves de su $listener
        $this->dispatch('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }

    public function render()
    {        
        // Obtener todos los salarios
        $salarios= Salario::all();
        $categorias= Categoria::all();

        return view('livewire.filtrar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
