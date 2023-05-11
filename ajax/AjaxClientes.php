

<?php 
    require_once '../controllers/ClienteController.php';
  
    class AjaxClientes{

        public function agregarCliente(){
            $respuesta = ClienteController::agregarCliente();
            echo json_encode($respuesta);
         
        }
        public function consultarClientes(){
            $id = filter_var($_POST['id_cliente'], FILTER_VALIDATE_INT);
            if(!$id){
                return;
            }
            $columna = 'id';
            $valor = $id;
            $respuesta = ClienteController::consultarClientes($columna, $valor);
            echo json_encode($respuesta);
        }
        public function editarCliente(){
            $respuesta = ClienteController::editarCliente();
            echo json_encode($respuesta);
        }
        public function eliminarCliente(){
            $respuesta = ClienteController::eliminarCliente();
            echo json_encode($respuesta);
        }

    }

$cliente = new AjaxClientes();

if(isset($_POST['nombre'])){
    $cliente->agregarCliente();
}
if(isset($_POST['id_cliente'])){
    $cliente->consultarClientes();
}
if(isset($_POST['id_editar_cliente'])){
    $cliente->editarCliente();
}
if(isset($_POST['id_eliminar_cliente'])){
    $cliente->eliminarCliente();
}


//traerme los clientes para llenarlos en el select para crear la venta
if($_SERVER['REQUEST_METHOD']=='GET'){
    $respuesta = ClienteController::consultarClientes(null, null);
    echo json_encode($respuesta);
}
