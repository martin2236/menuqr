<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Models\Producto;

class Menu extends Component
{
    use withPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public $categoria;

    public function render()
    {
        if($this->categoria == !null){
            $productos =Producto::where('titulo', 'like', $this->search.'%')
            ->where('categoria', 'like', $this->categoria.'%')
            ->get();
        }else{
            $productos =Producto::where('titulo', 'like', $this->search.'%')
            ->get();
        }
        

        return view('livewire.menu')->with([
            'productos'=> $productos
        ]);
    }

    public function categorias($categoria)
    {
        $this->categoria = $categoria;
    }
}
