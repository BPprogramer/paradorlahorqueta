<?php 

//     require_once '../controllers/ProveedorController.php';
//     require_once '../models/Proveedores.php';
//     class AjaxProveedores{
//         public function guardarProveedor(){
//             $respuesta =ProveedorController::guardarProveedor();
//             echo json_encode($respuesta);
//         }
//         public function consultarProveedor($columna = null,$valor = null){
      
//             $respuesta =ProveedorController::consultarProveedores($columna,$valor);
//             echo json_encode($respuesta);
//         }
//         public function editarProveedor(){
//             $respuesta = ProveedorController::editarProveedor();
//             echo json_encode($respuesta);
//         }
//         public function eliminarProveedor(){
//             $respuesta = ProveedorController::eliminarProveedor();
//             echo json_encode($respuesta);
//         }
//     }

// $proveedor = new AjaxProveedores();

// if(isset($_POST['nombre'])){
//     $proveedor->guardarProveedor();
//     return;
// }
// if(isset($_POST['id_proveedor'])){
//     $proveedor->consultarProveedor('id', $_POST['id_proveedor']);
//     return;
// }
// if(isset($_POST['id_editar_proveedor'])){
//     $proveedor->editarProveedor();
//     return;
// }
// if(isset($_POST['id_eliminar_proveedor'])){
//     $proveedor->eliminarProveedor();
//     return;
// }


// $proveedor->consultarProveedor();