
<?php 
    
                  
  
    $fecha_inicial = '2023-01-01';
   
    $fecha_final = date('Y-m-d');

   
    $respuesta;
    if($fecha_final != '' && $fecha_final != ''){
        
        // $fecha_inicial = filter_var($fecha_inicial, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}-\d{1,2}-\d{1,2}$/")));
 
        // $fecha_final = filter_var($fecha_final, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}-\d{1,2}-\d{1,2}$/")));


        // if (!$fecha_inicial || !$fecha_final) {
        //     $respuesta = VentasController::consultarVentas(null, null, null);
        //   } else {
        //     $respuesta = VentasController::consultarRangoVentas( $fecha_inicial, $fecha_final);
     
        //   }
    }else{

        //$respuesta = VentasController::consultarVentas(null, null, null);
        
       
        
       
    }
  
    $respuesta = htmlspecialchars(json_encode($respuesta), ENT_QUOTES);          ;
    echo '<input type="hidden" class="data_date" id="data_date" value="'.$respuesta.'">';
?>


<!-- <div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th">
            <h3 class="box-title">Grafico de Ventas</h3>
        </i>
    </div>
    <div class="box-body border-radius-none grafico_ventas">
        <div class="chart" id="line-chart" style="height: 250px">
        </div>
 
    </div>
</div> -->

<script>
    
</script>
