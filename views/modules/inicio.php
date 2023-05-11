
<div class="content-wrapper inicio">
   
    <section class="content-header">
        <h1>
            Inicio
            <small>Panel de Control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
           
            <li class="active">Tablero</li>
        </ol>
    </section>

    <?php if($_SESSION['perfil']=='administrador'){?>
    
        <section class="content">
            <div class="row">
                <?php
            
                    include "inicio/cajas_superiores.php";
        
                ?>
            </div>
            <div class="col-xs-12">
                <?php 
                    //include "inicio/productos_top.php"
                ?>
            </div>
            <!-- <div class="row">
                <div class="col-lg-12 grafico_ventas_inicio" id="line-chart">
                    <?php
                        //include "inicio/grafico_ventas.php";
                    ?>
                </div>
            </div> -->

        </section>
    <?php }else{?>
        <div class="box box-success">
            <h1 style="padding-left:15px">Bienvenido(a) <strong><?php echo $_SESSION['nombre']?></strong></h1>
        </div>
        
    <?php }?>
</div>