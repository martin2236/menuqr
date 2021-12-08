@extends('layouts.master')

@section('nombre')
    {{ __('Productos') }}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a type="button" href="{{ route('producto.create') }}" class=" mb-3 btn btn-primary">Crear</a>
                <table id="tabla" class="table display responsive table-dark table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr class="">
                            {{-- <th style="display: none;">ID</th> --}}
                            <th class="border text-center px-4 py-2">NOMBRE</th>
                            <th class="border text-center px-4 py-2">DESCRIPCION</th>
                            <th class="border text-center px-4 py-2">IMAGEN</th>
                            <th class="border text-center px-4 py-2">PRECIO</th>
                            <th class="border text-center px-4 py-2">CATEGORIA</th>
                            <th class="border text-center px-4 py-2">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                {{-- <td class="border text-center" style="display: none;">{{$curso->id}}</td> --}}
                                <td class="border text-center align-middle" style="max-width: 150px">{{ $producto->titulo }}</td>
                                <td class="border text-center align-middle">
                                    <textarea class="border text-center text-white bg-dark" style="min-width: 300px; height: 90px; margin: 0 auto;
                              width: 100%;">{{ $producto->descripcion }}</textarea>
                                </td>
                                <td class="border px-14 py-1 align-middle">
                                    <img style="display: block; margin:0 auto;" src="/images/{{ $producto->imagen }}"
                                        width="100px" height="100px">
                                </td>
                                <td class="border text-center align-middle" style="max-width: 150px">$ {{ $producto->precio }}</td>
                                <td class="border text-center align-middle" style="max-width: 150px">{{ $producto->categoria }}</td>
                                <td class="border px-4 py-2 align-middle">
                                    <div class="d-flex  justify-center rounded-lg text-lg" role="group">
                                        <!-- botón editar -->
                                        <a href="{{ route('producto.edit', $producto->id) }}"
                                            class="btn btn-success">Editar</a>

                                        <!-- botón borrar -->

                                        <form method="POST"
                                            action="{{ route('producto.destroy', ['producto' => $producto->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-1">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <div>
                            {{$productos->links()}}
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        (function() {
            'use strict'
            //debemos crear la clase formEliminar dentro del form del boton borrar
            //recordar que cada registro a eliminar esta contenido en un form  
            var forms = document.querySelectorAll('.formEliminar')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: '¿Confirma la eliminación del registro?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#20c997',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire('¡Eliminado!',
                                    'El registro ha sido eliminado exitosamente.', 'success');
                            }
                        })
                    }, false)
                })
        })()
    </script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }

            });
        });
    </script>
@endsection
