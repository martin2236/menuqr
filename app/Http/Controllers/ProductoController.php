<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Intervention\Image\Facades\Image;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('productos.index')->with([
            'productos' => Producto::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:25', 'descripcion' => 'required', 'categoria' => 'required','imagen' => 'required|image|mimes:jpeg,png,svg|max:1024'
        ]);

         $producto = $request->all();
          if($image = $request->file('imagen')) {
           $input['imagen'] = time().'.'.$image->Extension();
            $foto = $input['imagen'];
            $destinationPath = public_path('/images');
    
            $imgFile = Image::make($image->getRealPath());
    
            $imgFile->resize(400, 400)->save($destinationPath.'/'.$input['imagen']);
              $producto['imagen'] = "$foto";              
          }
         
          Producto::create($producto);
          return redirect()->route('producto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit')->with([
            'producto'=>$producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
       
        $request->validate([
            'titulo' => 'required', 'categoria' => 'required', 'descripcion' => 'required'
        ]);
         $cur = $request->all();
        
         if($image = $request->file('imagen')) {
          $input['imagen'] = time().'.'.$image->Extension();//se reemplazo el getClientOriginalExtension
           $foto = $input['imagen'];
           $destinationPath = public_path('/imagenP');
   
           $imgFile = Image::make($image->getRealPath());
   
           $imgFile->resize(400, 400)->save($destinationPath.'/'.$input['imagen']);
             $cur['imagen'] = "$foto";
             unlink($destinationPath.'/'.$producto->imagen);//borra imagen anterior              
         }else{
            unset($cur['imagen']);
         }
        $producto->update($cur);

         return redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $destinationPath = public_path('images');
        unlink($destinationPath.'/'.$producto->imagen);//borra la imagen de la carpeta imagen
        $producto->delete();
        return redirect()->route('producto.index');
    }
}
