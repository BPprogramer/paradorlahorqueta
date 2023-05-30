<?php if($_SESSION['perfil']!='administrador'){?>
    <script>window.location='inicio'</script>
<?php }?> 
<div class="content-wrapper">
   
    <section class="content-header">
        <h1>
            Administrar Proveedores
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
           
            <li class="active">Administrar Proveedores</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarProveedor">Agregar Proveedor</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas tablaProveedores" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Célular</th>
                            <th>Dirección</th>
                            <th>Boton de Acciones</th>
                        </tr>
                    </thead>
              
                </table>
            </div>
        </div>
    </section>
</div>

<div id="agregarProveedor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="formulario_guardar_proveedor">
                <div class="modal-header" style="background-color: #3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agreagar Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="ingresa Nombre del Proveedor">
                            </div>
                        </div> 
                        
                      
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="telefono" id="telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask placeholder="telefono">
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="direccion" id="direccion" placeholder="ingresa el direccion del proveedor">
                            </div>
                        </div> 
                   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary pull-right" id="btnGuardarProveedor" >Guardar Proveedor</button>
                </div>
            </form>
        </div>
  </div>
</div>

<!-- editar datos del Proveedor -->
<div id="editarProveedor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="formulario_editar_proveedor">
                <div class="modal-header" style="background-color: #3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar los datos del Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="editar_nombre" id="editar_nombre" placeholder="ingresa Nombre del proveedor">
                            </div>
                        </div> 
                      
                     
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="telefono" id="editar_telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask  placeholder="telefono">
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="direccion" id="editar_direccion" placeholder="ingresa el direccion del cliente">
                            </div>
                        </div> 
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_editar_proveedor"></input>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary pull-right" id="btnEditarProveedor" >Guardar Cambios</button>
                </div>
            </form>
        </div>
  </div>
</div>
   

 

