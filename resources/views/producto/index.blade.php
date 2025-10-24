@extends('template')

@section('title','Productos')
    
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('CSS')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
    
    <script>

        let message = "{{session('success')}}";
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
        icon: "success",
        title: message
        });
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    @can('ver-producto')
                            
    <div class="mb-4">
        <a href="{{route('productos.create')}}">
            <button type="button" class="btn btn-primary">Añadir nuevo producto</button>
        </a>
    </div>
    
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Presentación</th>
                        <th>Categorías</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item)
                        <tr>
                            <td>
                                {{$item->codigo}}
                            </td>
                            <td>
                                {{$item->nombre}}
                            </td>
                            <td>
                                {{$item->marca->caracteristica->nombre}}
                            </td>
                            <td>
                                {{$item->presentacion->caracteristica->nombre}}
                            </td>
                            <td>
                                @foreach ($item->categorias as $category)
                                    <div class="container">
                                        <div class="row">
                                            <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{$category->caracteristica->nombre}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                @if ($item->estado == 1)
                                    <span class="fw-bolder rounded p-1 bg-success text-white text-center">Activo</span>
                                @else
                                    <span class="fw-bolder rounded p-1 bg-danger text-white text-center">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                    @can('editar-producto')
                            
                                    <form action="{{route('productos.edit',['producto' => $item])}}" method="GET">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    
                                    @endcan

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verModal-{{$item->id}}">Ver</button>

                                    @can('eliminar-producto')
                            
                                    @if ($item->estado == 1)

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Desactivar</button>

                                    @else

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>

                                    @endif
                                    
                                    @endcan

                                    
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="verModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="">
                                                <span class="fw-bolder">Descripción: </span>{{$item->descripcion == '' ? 'No tiene' : $item->descripcion}}
                                            </label>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="">
                                                <span class="fw-bolder">Fecha de vencimiento: </span>{{$item->fecha_vencimiento == '' ? 'No tiene' : $item->fecha_vencimiento}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="">
                                                <span class="fw-bolder">Stock: </span>{{$item->stock}}
                                            </label>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="fw-bolder">Imagen: </label>
                                            <div>
                                                @if ($item->img_path != null)
                                                    <img src="{{ asset('storage/productos/'.$item->img_path) }}" alt="{{$item->nombre}}" class="img-fluid img-thumbnail border border-4 rounded">
                                                @else
                                                    <p class="text-muted">Sin imagen</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de confirmacion -->
                        <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$item->estado == 1 ? '¿Estás seguro de que quieres desactivar este producto?' : '¿Estás seguro de que quieres restaurar este producto?'}}
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                        <form action="{{route('productos.destroy',['producto'=>$item->id])}}" method="POST">

                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Confirmar</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endpush