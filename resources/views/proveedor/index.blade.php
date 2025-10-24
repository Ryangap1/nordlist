@extends('template')

@section('title', 'proveedores')

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
    <h1 class="mt-4 text-center">Proveedores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Proveedores</li>
    </ol>

    @can('ver-proveedor')
                            
    <div class="mb-4">
        <a href="{{route('proveedores.create')}}"><button type="button" class="btn btn-primary">Añadir nuevo proveedor</button></a>
    </div>
    
    @endcan
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de proveedores
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Documento</th>
                        <th>Tipo de persona</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $item)
                        <tr>
                            <td>
                                {{$item->persona->razon_social}}
                            </td>
                            <td>
                                {{$item->persona->direccion}}
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$item->persona->documento->tipo_documento}}</p>
                                <p class="text-muted mb-0">{{$item->persona->numero_documento}}</p>
                            </td>
                            <td>
                                {{$item->persona->tipo_persona}}
                            </td>
                            <td>
                                @if ($item->persona->estado == 1)
                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                @else
                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                    @can('editar-proveedor')
                            
                                    <form action="{{route('proveedores.edit',['proveedor'=>$item])}}" method="GET">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    
                                    @endcan

                                    @can('eliminar-proveedor')
                            
                                    @if ($item->persona->estado == 1)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Desactivar</button>

                                    @else
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>
                                    @endif
                                    
                                    @endcan

                                </div>
                            </td>
                        </tr>
                        <!-- Modal de confirmacion -->
                        <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$item->persona->estado == 1 ? '¿Estás seguro de que quieres desactivar este proveedor?' : '¿Estás seguro de que quieres restaurar este proveedor?'}}
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                        <form action="{{route('proveedores.destroy',['proveedor'=>$item->persona->id])}}" method="POST">

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