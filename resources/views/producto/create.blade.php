@extends('template')

@section('title','Crear productos')
    
@push('css')
    <style>
        #descripcion{
            resize: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{route ('productos.index')}}">Productos</a></li>
            <li class="breadcrumb-item active">Crear productos</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('productos.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    
                    <!-------CODIGO----->
                    <div class="col-md-6 mb-2">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo')}}">
                        @error('codigo')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------NOMBRE----->
                    <div class="col-md-6 mb-2">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------DESCRIPCION----->
                    <div class="col-md-12 mb-2">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="form-control"></textarea>
                        @error('descripcion')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------FECHA DE VENCIMIENTO----->
                    <div class="col-md-6 mb-2">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento')}}">
                        @error('fecha_vencimiento')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------IMAGEN----->
                    <div class="col-md-6 mb-2">
                        <label for="img_path" class="form-label">Imágen:</label>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="image/">
                        @error('img_path')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------MARCA----->
                    <div class="col-md-6 mb-2">
                        <label for="marca_id" class="form-label">Marca:</label>
                        <select data-size="5" title="Seleccione una marca" data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                            @foreach ($marcas as $item)
                                <option value="{{$item->id}}" {{old('marca_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        @error('marca_id')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------PRESENTACION----->
                    <div class="col-md-6 mb-2">
                        <label for="presentaciones_id" class="form-label">Presentación:</label>
                        <select data-size="5" title="Seleccione una presentación" data-live-search="true" name="presentaciones_id" id="presentaciones_id" class="form-control selectpicker show-tick">
                            @foreach ($presentaciones as $item)
                                <option value="{{$item->id}}" {{old('presentaciones_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        @error('presentaciones_id')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------CATEGORIAS----->
                    <div class="col-md-6 mb-2">
                        <label for="categorias" class="form-label">Categoría:</label>
                        <select data-size="5" title="Seleccione una categoria" data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                            @foreach ($categorias as $item)
                                <option value="{{$item->id}}" {{(in_array($item->id, old('categorias', []))) ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        @error('categorias')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------BOTONES----->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush