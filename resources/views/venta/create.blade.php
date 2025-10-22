@extends('template')

@section('title','Realizar venta')
    
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear ventas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{route ('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{route ('ventas.index')}}">Venta</a></li>
            <li class="breadcrumb-item active">Crear ventas</li>
        </ol>
    </div>

    <form action="{{route('ventas.store')}}" method="POST">
        @csrf
        <div class="container mt-4 ">
            <div class="row gy-4">
                <!---PRODUCTO VENTA---->
                <div class="col-md-8">
                    <div class="text-white bg-primary p-1 text-center">Detalles de la venta
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <!---PRODUCTO---->
                            <div class="col-md-12 mb-2">
                                <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data_size="3" title="Selecciona un producto">
                                    @foreach ($productos as $item)
                                        <option value="{{$item->id}}-{{$item->stock}}-{{$item->precio_venta}}">{{$item->codigo.' - '.$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!---STOCK---->
                            <div class="d-flex justify-content-end mb-4">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label for="stock" class="form-label col-sm-4">En stock:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!---CANTIDAD---->
                            <div class="col-md-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <!---PRECIO DE VENTA---->
                            <div class="col-md-4 mb-2">
                                <label for="precio_venta" class="form-label">Precio de venta:</label>
                                <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                            </div>

                            <!---DESCUENTO---->
                            <div class="col-md-4 mb-2">
                                <label for="descuento" class="form-label">Descuento:</label>
                                <input type="number" name="descuento" id="descuento" class="form-control">
                            </div>

                            <!---BOTON PARA AGREGAR---->
                            <div class="col-md-12 mb-2 mt-2 text-end">
                                <button id="btn_agregar" class="btn btn-primary">Agregar</button>
                            </div>

                            <!---TABLA PARA EL DETALLE DE LA VENTA---->
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary text white">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio venta</th>
                                                <th>Descuento</th>
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
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="tr-oscuro">
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th><span id="sumas">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">IVA %</th>
                                                <th><span id="IVA">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th><input type="hidden" name="total" value="0" id="inputTotal"><span id="total">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!---BOTON PARA CANCELAR LA VENTA---->
                            <div class="col-md-12 mb-2">
                                <button class="btn btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="cancelar">Cancelar venta</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!---VENTA---->
                <div class="col-md-4">
                    <div class="text-white bg-success p-1 text-center">Datos generales
                    </div>
                    <div class="p-3 border border-3 border-success">
                        <div class="row">
                            <!---CLIENTE---->
                            <div class="col-md-12 mb-2">
                                <label for="cliente_id" class="form-label">Cliente:</label>
                                <select name="cliente_id" id="cliente_id" class="form-control selectpicker show-tick" data-live-search="true" title="selecciona" data-size="3">
                                    @foreach ($clientes as $item)
                                        <option value="{{$item->id}}">{{$item->persona->razon_social}}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---TIPO DE COMPROBANTE---->
                            <div class="col-md-12 mb-2">
                                <label for="comprobante_id" class="form-label">Comprobante:</label>
                                <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker show-tick" data-live-search="true" title="selecciona" data-size="3">
                                    @foreach ($comprobantes as $item)
                                        <option value="{{$item->id}}">{{$item->tipo_comprobante}}</option>
                                    @endforeach
                                </select>
                                @error('comprobante_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---NUMERO DE COMPROBANTE---->
                            <div class="col-md-12 mb-2">
                                <label for="numero_comprobante" class="form-label">Número de comprobante:</label>
                                <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control">
                                @error('numero_comprobante')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---IMPUESTO---->
                            <div class="col-md-6 mb-2">
                                <label for="impuesto" class="form-label">Impuesto (IVA):</label>
                                <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success">
                                @error('impuesto')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---FECHA---->
                            <div class="col-md-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                                <?php
                                use Carbon\Carbon;
                                $fecha_hora = Carbon::now()->toDateTimeString();
                                ?>
                                <input type="hidden" name="fecha_hora" value="{{$fecha_hora}}">
                            </div>

                            <!---BOTONES---->
                            <div class="col-md-12 mb-2 text-center">
                                <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA CANCELAR LA VENTA -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal de confirmacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar esta venta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="btnCancelarVenta" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
            </div>
            </div>
        </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#producto_id').change(mostrarValores);

        /*
            $('#btn_agregar').click(function(){
                agregarProducto();
            });

            $('#btnCancelarCompra').click(function(){
                cancelarCompra();
            });

            disableButtons();

            $('#impuesto').val(impuesto + '%'); */
        });

        function mostrarValores(){
            let dataProducto = document.getElementById('producto_id').value.split('-');
        }

    </script>
@endpush