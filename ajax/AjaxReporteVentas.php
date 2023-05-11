
<?php 
    require_once '../controllers/ReporteVentasController.php';
    require_once '../models/Ventas.php';

    class AjaxReporteventas{
        public function consultarDatosventas(){
           
            $respuesta = ReporteVentasController::consultarDatosventas($_POST);
            echo json_encode($respuesta);
        }
    }

    $datos = new AjaxReporteventas();
    if(isset($_POST['fecha_final'])){
        
        $datos->consultarDatosventas();
    }