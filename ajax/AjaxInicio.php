
<?php 
    require_once '../controllers/InicioController.php';
    require_once '../models/Ventas.php';
    require_once '../models/Categorias.php';
    require_once '../models/Clientes.php';
    require_once '../models/Productos.php';
    require_once '../models/Credito.php';
    class AjaxInicio{
            public function consultarDatosInicio(){
                $respuesta = InicioController::inicio();
                echo json_encode($respuesta);
            }
    }

    $inicio = new AjaxInicio;
    $inicio->consultarDatosInicio();