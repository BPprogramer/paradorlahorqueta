

<?php 

    require_once "../controllers/UsuarioController.php";
    require_once "../models/Usuarios.php";


    


    class AjaxUsuarios{
        //editar usuario
 

        public function ajaxEditarUsuario(){
         

                $usuario = new UsuarioController();
                $respuesta = $usuario->mostrarUsuarios('usuarios', 'id', $_POST['idUsuario']); 
                echo json_encode($respuesta);
            
             }
      
        /* ************activar usuario */
  

        public function ajaxEditarEstadoUsuario(){
      
            

                $id = $_POST['idUsuario'];
                $estado = $_POST['estadoUsuario'];

                $tabla = 'usuarios';
                $columnaEstado = 'estado';
                $valorEstado = $estado;
                $columnaId = "id";
                $valorId = $id;
             
                $usuario = new Usuarios();
                $respuesta = $usuario->editarDatosUsuario($tabla, $columnaEstado, $valorEstado, $columnaId, $valorId);
                json_encode($respuesta);
            
        }

        /* **************** validar si un usuario ya existo o no */
        public function ajaxValidarUsuario($tabla, $columna, $valor){
            
            $usuario = new UsuarioController();
            $respuesta = $usuario->mostrarUsuarios($tabla, $columna, $valor);
            echo json_encode($respuesta);
        }

        public function ajaxConsultarVendedor(){
            $usuario = new UsuarioController();
            $respuesta = $usuario->mostrarUsuarios('usuarios', 'id', $_POST['id_vendedor']);
            echo json_encode($respuesta['nombre']);
        }
    }

 $usuarioAjax = new AjaxUsuarios();

  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['idUsuario'])){
    $usuarioAjax->ajaxEditarUsuario();
   } 
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['estadoUsuario'])){
    $usuarioAjax->ajaxEditarEstadoUsuario();
   }


 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['nuevoUsuario'])){
    $usuarioAjax->ajaxValidarUsuario('usuarios','usuario',$_POST['nuevoUsuario']);
   }
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['idUsuarioActual'])){
    $usuarioAjax->ajaxValidarUsuario('usuarios', 'id',$_POST['idUsuarioActual']);
 }
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['id_vendedor'])){
      $usuarioAjax->ajaxConsultarVendedor();
 }

