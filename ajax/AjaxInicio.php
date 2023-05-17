
<?php 
/* DB_HOST = localhost
DB_USER = u640126326_piamba2161
DB_PASS = Piamba216160224.
DB_BD = u640126326_horqueta */
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