<?php if($_SESSION['perfil']=='vendedor'){?>
 <script>//window.location='inicio'</script>
<?php }?> 
<div class="content-wrapper">
   
    <section class="content-header">
        <h1>
            Reporte Ventas
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
           
            <li class="active">Reporte Ventas</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="box">
            <div class="box-header with-border">
                <div class="input-group">
                    <button class="btn btn-default" id="daterange_btn_reporte">
                        <span>
                            <i class="fa fa-calendar"></i> Rango de Fecha
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>

              
                <div class="box-tools pull-right">
                    <a href="views/modules/descargar-reporte.php?type=report&fi=<?php echo $_GET['fi']??date('Y-m-d', strtotime('-2 days'))?>&ff=<?php echo $_GET['ff']??date('Y-m-d');?>">
                        <button class="btn btn-success" style="margin-top:5px">
                            Descargar Reportes en Excel
                        </button>
                    </a>
                </div>
                
                
            </div>
            <div class="box-body"> <!-- grficos -->
                <div class="row">

                    <div class="col-xs-12">
                        <?php 
                            include "reportes/cajas_superiores.php"
                        ?>
                    </div>
                  
                    <div class="col-xs-12">
                        <?php 
                            //include "reportes/productos_top.php"
                        ?>
                    </div>
                    <div class="col-xs-12">
                        <?php 
                           // include "reportes/vendedores_top.php"
                        ?>
                    </div>
                    <div class="col-xs-12">
                        <?php 
                            //include "reportes/clientes_top.php"
                        ?>
                    </div>
                    <div class="col-xs-12">
                        <?php 
                           include "reportes/grafico-ventas.php"
                        ?>
                    </div>
                </div>
            </div>
 
        </div>
 

    </section>

</div>