<?php 
    require_once 'models/Productos.php';
?>
<div class="content-wrapper">
   
    <section class="content-header">
        <h1>
           Editar Venta
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
           
            <li class="active">Crear Venta</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <form  method="post" id="formulario_editar">
                            <div class="box-body">
                                <div class="box">
                                      <!-- consultar la venta con la variable G$_GET -->
                                      <?php 
                                            $columna = 'id';
                                            $valor = $_GET['id'];
                                    
                                            $venta = VentasController::consultarVentas($columna, $valor, false);
                                            // echo "<pre>";
                                            // var_dump($venta);
                                            // echo "</pre>";
                                            
                                           
                                            //$cliente = Clientes::consultarClientes('clientes', 'id', $venta['id_cliente']);
                                            $vendedor = Usuarios::consultarUsuario('usuarios', 'id', $venta['id_vendedor']);

                                            $productos = json_decode($venta['productos']);
                                         
                                           
                                            //$impuesto = ($venta['total']*100/$venta['neto'])-100;
                                            $select_productos = Productos::consultarProductos('productos', null, null);
                                          
                                         

                                    
                                            
                                     
                                           
                                         
                                    ?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span><!-- vendedor -->
                                            <div class="form-control"  style="background-color:#f9f9f9;"><?php echo $vendedor['nombre']??'anonimo'?></div>
                                            <input type="hidden" id="id_vendedor" name="id_vendedor" value="<?php echo $venta['id_vendedor']?>">
                                        </div>
                                    </div>
                                    <div class="form-group"><!-- codigo venta -->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <?php 
                                                // $columna = null;
                                                // $valor = null;
                                                // $orderById = 'id';
                                                // $ventas = VentasController::consultarVentas($columna, $valor, $orderById);
                                            ?>
                                            <div class="form-control" id="codigo" name="codigo" style="background-color:#f9f9f9;"><?php echo  $venta['codigo'] ?></div>
                                        </div>
                                    </div>
                                <!--     <div class="row">
                                        
                                        <div class="col-xs-12 col-sm-4 col-md-12">
                                            <div class="input-group pull-right">
                                                
                                                
                                                    <button type="button" class="btn btn-default   btn-md" data-toggle="modal" data-target="#agregarCliente" data-dismiss="modal">Agregar Cliente a la venta</button>
                                               
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- aqui se agregan los productos -->
                                    <div class="form-group row productosVenta">
                                       
                                        <?php foreach($productos as $producto){ 
                                            //  var_dump($producto);
                                            
                                            $respuesta_producto =  ProductosController::consultarProductos('id', $producto->id);
                                            // echo "<pre>";
                                            // var_dump($respuesta_producto);
                                            // echo "</pre>";
                                            
                                            ?>
                                            <div class="row mb-4 rowVenta desktop"  style="margin-bottom:10px; padding:5px 15px">
                                                <div class="col-sm-6" style="padding-right:10px">
                                                    <div class="input-group" style="padding-right:5px">
                                                        <span class="input-group-addon">
                                                            <button class="btn btn-danger btn-xs eliminarProductoVenta" id_producto_eliminar="<?php echo $producto->id ?>" type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </span>
                                                        <input type="text" value="<?php echo $producto->descripcion ?>" id_producto="<?php echo $producto->id ?>" class="form-control descripcion_producto" id="descripcion_producto" name="agregar_producto" placeholder="descripcion  producto"> 
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-xs-6" class="contenido_cantidad">
                                                            <input type="number" value="<?php echo $producto->cantidad ?>" class="form-control cantidad_producto" stock_actual="<?php echo $respuesta_producto['stock']?>" stock="<?php echo $producto->cantidad+$respuesta_producto['stock']?>" id="cantidad_producto" name="cantidad_producto" min="1" placeholder="cantidad">
                                                        </div>
                                                        <div class="col-xs-6 contenido_precio" style="padding-left:0px">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                                <div type="number" class="form-control precio_producto" id="precio_producto" name="precio_producto" style="background-color:#f9f9f9;" precioCompra = "<?php echo $respuesta_producto['precio_compra'] ?>" precioProducto = "<?php echo $respuesta_producto['precio_venta'] ?>"><?php echo number_format($producto->precio_total)?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        

                                        <!-- para dispositivos -->
                                                
                                        <?php }?>
                                    </div>
                                    
                                    <!-- aqui se carg el arreglo con toda la iformacion osbre productos y precios -->
                                    <input type="hidden" id="listaProductos" name="productos">

<!-- 
                                    <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Producto</button> -->
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 pull-right">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>Total</th>
                                                    </tr>
                                                
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       
                                                        <td>
                                                            <div class="input-group input-group-lg">
                                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                                    <div style="width:150px" type="number" class="form-control input-lg" min="0" id="total_venta" name="total" style="background-color:#f9f9f9;"><?php echo $venta['total'] ?></div>
                                                                   
                                                            
                                                            </div>
                                                        </td>  
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-xs-12 col-md-6" style="padding-right:15px">
                                            <div class=""><!-- metod de pago -->
                                                <select name="metodo_pago" id="metodo_pago"  class="form-control">
                                                    <option  disabled>Seleccione Metodo de pago</option>
                                                    <option value="efectivo">De Contado</option>
                                                    
                                                    <option value="credito" >Crédito</option>
                                                </select>
                                            </div>
                                        </div>
                                    <!--     <div class="col-xs-12 col-md-8">
                                            <div class="contenedor_metodo_pago row">
                                                 <div class="col-xs-6 contenedor_valor_efectivo" style="">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                        <input type="text"  val="" class="form-control valor_efectivo" placeholder="cantidad pagar" style="font-size:20px">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 contenedor_cambio_efectivo" style="padding-left:0px ">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                        <input type="text" val="" class="form-control cambio_efectivo" placeholder="cambio" readonly style="font-size:20px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-xs-12" style="margin-top:10px">
                                           
                                                <div class="contenedor_metodo_pago row"><!-- auiinsertamos desde jquery egu nel metodo seleccionado -->
                                                    
                                                    <div class="col-xs-6 contenedor_valor_efectivo" style="">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input type="text"  value="" class="form-control valor_efectivo" placeholder="cantidad pagar" style="font-size:20px">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 contenedor_cambio_efectivo" style="padding-left:0px ">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input type="text" value="" class="form-control cambio_efectivo" placeholder="cambio" readonly style="font-size:20px">
                                                        </div>
                                                    </div>

                                                </div>
                                        
                                              <!--   <div class="col-xs-6 contenedor_valor_abono" style="">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                        <input type="text"  value="" class="form-control valor_abono" placeholder="abono" style="font-size:20px">
                                                    </div>
                                                
                                                </div>
                                                <div class="col-xs-6 contenedor_valor_deuda" style="padding-left:0px ">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                        <input type="text" value="" class="form-control valor_deuda" placeholder="deuda" readonly style="font-size:20px">
                                                    </div>
                                                </div> -->
                                        
                                        </div>
                                        
                                        <input type="hidden" name="lista_metodo_pago" id="lista_metodo_pago"> <!-- aqui almacenamos el metodo de pago -->
                                    </div>
                                    <br>
                                </div>
                                    <!-- agregar Cliente para fiados -->
                                   <!--  <div class="row hidden contenedor_credito" style="margin-top:30px">
                                        <div class="col-xs-12 col-sm-8 col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <select type="text" class="form-control clienteCrearVenta" id="id_cliente" name="id_cliente" placeholder="nombre del cliente">
                                                    <option value="anonimo" selected disabled>--Seleccione--</option>
                                        
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-xs-12 col-sm-4 col-md-12">
                                            <div class="input-group pull-right">
                                                
                                                    <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#agregarCliente" data-dismiss="modal">Agregar Cliente a la venta</button>
                                                
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- agregar cliente a la venta -->
                                <div class="row contenedor_credito hidden" style="margin-top:30px">
                                    <div class="col-xs-12 col-sm-8 col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                            <select type="text" class="form-control clienteCrearVenta" id="id_cliente" name="id_cliente" placeholder="nombre del cliente" style="font-size:18px">
                                                <option value="anonimo" selected disabled>--Seleccione--</option>
                                                
                                            
                                            </select>
                                        </div>
                                      <!--   <input hidden id="id_cliente_venta" id_cliente_venta=""> -->
                                    </div> 
                                    <div class="col-xs-12 col-sm-4 col-md-12">
                                        <div class="input-group pull-right">
                                            
                                                <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#agregarCliente" data-dismiss="modal">Agregar Cliente a la venta</button>
                                            
                                        </div>
                                    </div>
                                </div>

                           
                              
                            </div>
                            <div id="alerta"></div>
                            <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right btn_crear_venta">guardar Cambios</button>
                                    <input type="hidden" id="id_venta_editar" value="<?php echo $venta['id'] ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <div class="box-body">
                            <table class="table table-bordered table-striped dt-responsive tablas tablaProductosVentas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imagen</th>
                                        <th>codigo</th>
                                       
                                        <th>Descripción</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </section>

</div>

<!-- modal agregar cliente -->

<div id="agregarCliente" class="modal fade"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="formulario_guardar_cliente">
                <div class="modal-header" style="background-color: #3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="ingresa Nombre del cliente">
                            </div>
                        </div> 
                     
                      
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="telefono" id="telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask placeholder="ingresa el telefono del cliente">
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="direccion" id="direccion" placeholder="ingresa el direccion del cliente">
                            </div>
                        </div> 
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary pull-right" id="btnGuardarCliente" >Guardar Cliente</button>
                </div>
            </form>
        </div>
  </div>
</div>

