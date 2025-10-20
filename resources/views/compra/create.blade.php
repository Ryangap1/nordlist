@extends('template')

@section('title','Crear compras')
    
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear compra</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{route ('compras.index')}}">Compra</a></li>
            <li class="breadcrumb-item active">Crear compra</li>
        </ol>
    </div>

    <form action="" method="POST">
        @csrf
        <div class="container mt-4 ">
            <div class="row gy-4">
                <!---COMPRA PRODUCTO---->
                <div class="col-md-8">
                    <div class="text-white bg-primary p-1 text-center">Detalles de la compra
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <!---PRODUCTO---->
                            <div class="col-md-12 mb-2">
                                <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data_size="3" title="Selecciona un producto">
                                    @foreach ($productos as $item)
                                        <option value="{{$item->id}}">{{$item->codigo.' - '.$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!---CANTIDAD---->
                            <div class="col-md-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <!---PRECIO DE COMPRA---->
                            <div class="col-md-4 mb-2">
                                <label for="precio_compra" class="form-label">Precio de compra:</label>
                                <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                            </div>

                            <!---PRECIO DE VENTA---->
                            <div class="col-md-4 mb-2">
                                <label for="precio_venta" class="form-label">Precio de venta:</label>
                                <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                            </div>

                            <!---BOTON PARA AGREGAR---->
                            <div class="col-md-12 mb-2 mt-2 text-end">
                                <button class="btn btn-primary">Agregar</button>
                            </div>

                            <!---TABLA PARA EL DETALLE DE LA COMPRA---->
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary text white">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio compra</th>
                                                <th>Precio venta</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Sumas</th>
                                                <th>0</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>IGV %</th>
                                                <th>0</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th>Total</th>
                                                <th>0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---PRODUCTO---->
                <div class="col-md-4">
                    <div class="text-white bg-success p-1 text-center">Datos generales
                    </div>
                    <div class="p-3 border border-3 border-success">
                        <div class="row">
                            <!---PROVEEDOR---->
                            <div class="col-md-12 mb-2">
                                <label for="proveedor_id" class="form-label">Proveedor:</label>
                                <select name="proveedor_id" id="proveedor_id" class="form-control selectpicker show-tick" data-live-search="true" title="selecciona" data-size="3">
                                    @foreach ($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->persona->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!---TIPO DE COMPROBANTE---->
                            <div class="col-md-12 mb-2">
                                <label for="comprobante_id" class="form-label">Comprobante:</label>
                                <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker show-tick" data-live-search="true" title="selecciona" data-size="3">
                                    @foreach ($comprobantes as $item)
                                        <option value="{{$item->id}}">{{$item->tipo_comprobante}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!---NUMERO DE COMPROBANTE---->
                            <div class="col-md-12 mb-2">
                                <label for="numero_comprobante" class="form-label">Número de comprobante:</label>
                                <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control">
                            </div>

                            <!---IMPUESTO---->
                            <div class="col-md-6 mb-2">
                                <label for="impuesto" class="form-label">Impuesto:</label>
                                <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success">
                            </div>

                            <!---FECHA---->
                            <div class="col-md-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            </div>

                            <!---BOTONES---->
                            <div class="col-md-12 mb-2 text-center">
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush