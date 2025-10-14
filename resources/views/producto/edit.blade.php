@extends('template')

@section('title','Editar productos')
    
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
        <h1 class="mt-4 text-center">Editar productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{route ('productos.index')}}">Productos</a></li>
            <li class="breadcrumb-item active">Editar productos</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('productos.update',['producto'=>$producto])}}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    
                    <!-------CODIGO----->
                    <div class="col-md-6 mb-2">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo',$producto->codigo)}}">
                        @error('codigo')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------NOMBRE----->
                    <div class="col-md-6 mb-2">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$producto->nombre)}}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------DESCRIPCION----->
                    <div class="col-md-12 mb-2">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="form-control">{{old('descripcion',$producto->descripcion)}}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------FECHA DE VENCIMIENTO----->
                    <div class="col-md-6 mb-2">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento',$producto->fecha_vencimiento)}}">
                        @error('fecha_vencimiento')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                        <!-------IMAGEN----->
                    <div class="col-md-6 mb-2">
                        <label for="img_path" class="form-label">Imágen:</label>

                        @if ($producto->img_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/productos/' . $producto->img_path) }}" 
                                    alt="Imagen actual" 
                                    width="120" 
                                    class="img-thumbnail" 
                                    id="currentImage">

                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                    <label class="form-check-label" for="remove_image">
                                        Quitar imagen actual
                                    </label>
                                </div>
                            </div>
                        @endif

                        <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">

                        {{-- Contenedor donde se mostrará la previsualización de la nueva imagen --}}
                        <div id="previewContainer" class="mt-2"></div>

                        @error('img_path')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>

                    <!-------MARCA----->
                    <div class="col-md-6 mb-2">
                        <label for="marca_id" class="form-label">Marca:</label>
                        <select data-size="5" title="Seleccione una marca" data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                            @foreach ($marcas as $item)
                            @if ($producto->marca_id == $item->id)
                                <option selected value="{{$item->id}}" {{old('marca_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @else
                                <option value="{{$item->id}}" {{old('marca_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endif
                                
                            @endforeach
                        </select>
                        @error('marca_id')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------PRESENTACION----->
                    <div class="col-md-6 mb-2">
                        <label for="presentacion_id" class="form-label">Presentación:</label>
                        <select data-size="5" title="Seleccione una presentación" data-live-search="true" name="presentacion_id" id="presentacion_id" class="form-control selectpicker show-tick">
                            @foreach ($presentaciones as $item)
                            @if ($producto->presentacion_id == $item->id)
                                <option selected value="{{$item->id}}" {{old('presentacion_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @else
                                <option value="{{$item->id}}" {{old('presentacion_id') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endif
                                
                            @endforeach
                        </select>
                        @error('presentacion_id')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------CATEGORIAS----->
                    <div class="col-md-6 mb-2">
                        <label for="categorias" class="form-label">Categoría:</label>
                        <select data-size="5" title="Seleccione una categoria" data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                            @foreach ($categorias as $item)
                            @if (in_array($item->id,$producto->categorias->pluck('id')->toarray()))
                                <option selected value="{{$item->id}}" {{(in_array($item->id, old('categorias', []))) ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @else
                                <option value="{{$item->id}}" {{(in_array($item->id, old('categorias', []))) ? 'selected' : ''}}>{{$item->nombre}}</option>
                            @endif
                                
                            @endforeach
                        </select>
                        @error('categorias')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!-------BOTONES----->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="reset" class="btn btn-secondary">Reiniciar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
    const removeCheck = document.getElementById('remove_image');
    const fileInput = document.getElementById('img_path');

    if (removeCheck) {
        removeCheck.addEventListener('change', function() {
            fileInput.disabled = this.checked;
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('img_path');
        const previewContainer = document.getElementById('previewContainer');
        const removeCheck = document.getElementById('remove_image');
        const currentImage = document.getElementById('currentImage');

        // --- Previsualizar nueva imagen ---
        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            previewContainer.innerHTML = ''; // limpia previsualización anterior

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    img.style.width = '150px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

        // --- Manejar el checkbox de "Quitar imagen actual" ---
        if (removeCheck) {
            removeCheck.addEventListener('change', function() {
                const checked = this.checked;

                // Deshabilitar input de archivo
                input.disabled = checked;

                // Ocultar imagen actual y previsualización si se marca la casilla
                if (currentImage) currentImage.style.display = checked ? 'none' : 'block';
                if (checked) previewContainer.innerHTML = '';
            });
        }
    });
</script>
@endpush