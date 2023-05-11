<?php if($_SESSION['perfil']=='vendedor'){?>
    <script>window.location='inicio'</script>
<?php }?> 
 
<div class="content-wrapper">
   
    <section class="content-header">
        <h1>
            Administrar Categorías
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
           
            <li class="active">Administrar Categorías</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCategoria">Agregar Categoría</button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $categorias =  CategoriasController::consultarCategorias(null, null);
                              $numero = 0;
                        ?>
                        <?php foreach($categorias as $categoria){
                            $numero = $numero+1;    
                        ?>
                            <tr>
                                <td><?php echo $numero;?></td>
                                <td class="text-uppercase"><?php echo $categoria['nombre']?></td>
                                <td>
                                    <div class="">
                                        <button class="btn btn-warning btnEditarCategoria" data-toggle="modal" data-target="#modalEditarCategoria" idCategoria="<?php echo $categoria['id']?>"><i class="fa fa-pencil"  ></i></button>
                                        <button class="btn btn-danger btnEliminarCategoria"  idCategoria="<?php echo $categoria['id']?>"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- modal agregar categoria -->

<div id="agregarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST">
                <div class="modal-header" style="background-color: #3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agreagar Categoría</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="nombre" placeholder="ingresa Nombre de la Categoría" >
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary pull-right">Guardar Categoría</button>
                </div>
                <?php
              
                    CategoriasController::crearCategoria();
                ?>
            </form>
        </div>
  </div>
</div>
<!-- modal editar categoria -->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST">
                <div class="modal-header" style="background-color: #3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Categoría</h4>
                </div>
                <div class="modal-body" style="">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input-lg" name="nombreEditar" id="editarCategoria" placeholder="ingresa Nombre de la Categoría" >
                                <input type="hidden" name="idEditarCategoria" id="idEditarCategoria">
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary pull-right" >Guardar Cambios</button>
                </div>
                <?php
              
                   CategoriasController::editarCategoria();
              
                 
                ?>
            </form>
        </div>
  </div>
</div>

<?php 
       CategoriasController::eliminarCategoria();
?>