@extends('layouts.master')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
       
        <h1 class="fs-1 text-center">Editar producto</h1>

         

        @if ($errors->any())
        <h1 class="text-lg bg-red-300 underline">Por favor corrija los siguientes errores:</h1>
            <div class="bg-red-300">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 ml-5 ">
                <div class="grid grid-cols-1">
                    <label class="uppercase text-xs text-dark font-semibold">Nombre:</label>
                    <input name="titulo" class="col-10 py-2 px-3 rounded-lg border-2 " type="text" value="{{$producto->titulo}}" required/>
                </div>
                <div class="grid grid-cols-1">
                    <label class="uppercase text-xs text-dark font-semibold">Descripción:</label>
                    <textarea name="descripcion" class="col-10 py-2 px-3 rounded-lg border-2" 
                     type="text" required>{{$producto->descripcion}}</textarea>
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <label class="uppercase text-xs text-dark font-semibold">Precio:</label>
                    <input name="precio" class="col-10 py-2 px-3 rounded-lg border-2 " type="number"value="{{$producto->precio}}"  required/>
                </div>
                <div class="grid grid-cols-1 mt-3">
                    <label class="uppercase text-xs text-dark font-semibold">Categoria:</label>
                    <select name="categoria" class="col-10 py-2 px-3 rounded-lg border-2 " required>
                    <option value=""></option>
                    <option value="aperitivo">Aperitivo</option>
                    <option value="principal">Principal</option>
                    <option value="bebida">Bebida</option>
                    <option value="postre">Postre</option>
                    </select>
                </div>
            </div>
            <div class="row ml-5">
               <div class="col-5 mt-5 mx-7">
                   <label for="">imagen anterior</label>
                <img style="height:100px; width: 100px" class="rounded-circle" src="/images/{{ $producto->imagen }}">        
            </div> 
             <!-- Para ver la imagen seleccionada, de lo contrario no se -->
             <div class="col-5 mt-5 mx-7 ">
                <label for="">imagen nueva</label>
                <img id="imagenSeleccionada" style="height:100px; width: 100px" class="rounded-circle">           
            </div>
            </div>

            <div class="grid grid-cols-1 mt-5 ml-5">
            <label class="uppercase md:text-sm text-xs text-dark font-semibold mb-1">Subir Imagen</label>
                <div class='flex items-center justify-center w-full'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover: group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Click aqui para seleccionar una imagen</p>
                        </div>
                    <input name="imagen" id="imagen" type='file' class="hidden" />
                    </label>
                </div>
            </div>

            <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                <a href="{{ route('producto.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form> 

        </div>
    </div>
</div>


<!-- Script para ver la imagen antes de CREAR UN NUEVO PRODUCTO -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>   
$(document).ready(function (e) {   
    $('#imagen').change(function(){            
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#imagenSeleccionada').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
    });
});
</script>
@endsection