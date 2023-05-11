
<?php 
    
                  
  
    $fecha_inicial = $_GET['fi']??date('Y-m-d', strtotime('-2 days'));
   
    $fecha_final = $_GET['ff']??date('Y-m-d');

   
    $respuesta;
    if($fecha_final != '' && $fecha_final != ''){
        
        $fecha_inicial = filter_var($fecha_inicial, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}-\d{1,2}-\d{1,2}$/")));
 
        $fecha_final = filter_var($fecha_final, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}-\d{1,2}-\d{1,2}$/")));


        // if (!$fecha_inicial || !$fecha_final) {
        //     $respuesta = VentasController::consultarVentas(null, null, null);
        //   } else {
        //     $respuesta = VentasController::consultarRangoVentas( $fecha_inicial, $fecha_final);
     
        //   }
    }else{

        // $respuesta = VentasController::consultarVentas(null, null, null);
   
       
        
       
    }
    // echo "<pre>";
    // var_dump($respuesta);
    // echo "</pre>";
    
    // $respuesta = htmlspecialchars(json_encode($respuesta), ENT_QUOTES);          ;
    // echo '<input type="hidden" class="data_date" id="data_date" value="'.$respuesta.'">';
    echo '<input type="hidden" class="data_date" id="data_date_in" value="'.$fecha_inicial.'">';
    echo '<input type="hidden" class="data_date" id="data_date_fin" value="'.$fecha_final.'">';
?>


<div class="box box-solid bg-teal-gradient  grafico_ventas_reporte">
  <!--   <div class="box-header">
        <i class="fa fa-th">
            <h3 class="box-title">Grafico de Ventas</h3>
        </i>
    </div>
    <div class="box-body border-radius-none">
        <div class="chart grafico_ventas_reporte" id="line-chart" style="height: 250px"></div>
       
     
        
    </div> -->
</div>

<script>
    
</script>


