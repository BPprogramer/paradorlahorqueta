
<?php 
    require_once '../controllers/ReporteVentasController.php';
    require_once '../models/Ventas.php';

    class AjaxReporteVentas{
        public function consultarDatosventas(){
           
            $respuesta = ReporteVentasController::consultarDatosventas($_POST);
            echo json_encode($respuesta);
        }
    }

    $datos = new AjaxReporteVentas();
    if(isset($_POST['fecha_final'])){
        
        $datos->consultarDatosventas();
    }