
<?php 

require_once "../controllers/CategoriasController.php";
require_once "../models/Categorias.php";

    class AjaxCategorias{
        public function ajaxEditarCategoria($idCategoria){
            $columna = 'id';
            $valor = $idCategoria;
            $respuesta = CategoriasController::consultarCategorias($columna, $valor);
            echo json_encode($respuesta);
            
        }
    }

    $categoriaAjax = new AjaxCategorias();
   
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['idCategoria'])){
      
        $categoriaAjax->ajaxEditarCategoria($_POST['idCategoria']);
    }

   



