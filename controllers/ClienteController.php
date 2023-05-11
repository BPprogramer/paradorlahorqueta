

<?php 
    require_once '../models/Clientes.php';

    class ClienteController{
        public static function consultarClientes($columna, $valor){
            
            $tabla = 'clientes';
        
            return Clientes::consultarClientes($tabla, $columna,$valor);

        }
        public static function agregarCliente(){
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
            $parttern_telefono = '/^[()\-0-9 ]+$/';
            $parttern_direccion = '/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
            

            if(preg_match($parttern_2,$nombre ) && 
                preg_match( $parttern_telefono,$telefono) &&
                preg_match( $parttern_direccion,$direccion)){
                    
                    $tabla = 'clientes';
                    $datos = array('nombre'=>$nombre, 'telefono'=>$telefono, 'direccion'=>$direccion);
                    $cliente = new Clientes();
                   
                    return $cliente->agregarCliente($tabla, $datos);
                    
            }else{
                return 'no-validate';
            }
         
        }

        public static function editarCliente(){
            
            $id = filter_var($_POST['id_editar_cliente'], FILTER_VALIDATE_INT);
            if(!$id){
                return ;
            }
          
            $nombre = $_POST['editar_nombre'];
            $telefono = $_POST['editar_telefono'];
            $direccion = $_POST['editar_direccion'];
          
            $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
            $parttern_telefono = '/^[()\-0-9 ]+$/';
            $parttern_direccion = '/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
           

            if(preg_match($parttern_2, $nombre ) && 
                preg_match( $parttern_telefono, $telefono) &&
                preg_match( $parttern_direccion, $direccion)){
                    
                    $tabla = 'clientes';
                    $datos = array('id'=>$id, 'nombre'=>$nombre,  'telefono'=>$telefono, 'direccion'=>$direccion);
                    $cliente = new Clientes();
              
                    return $cliente->editarCliente($tabla, $datos);
                    
            }else{
                return 'no_validate';
            }

        }
        public static function eliminarCliente(){
            $id = filter_var($_POST['id_eliminar_cliente'], FILTER_VALIDATE_INT);
            if(!$id){
                return 'error';
            }
            $respuesta = Clientes::consultarClientes('clientes', 'id', $id);
            
            if($respuesta['deuda']>0){
                return 'no_permitido';
            }
            $cliente = new Clientes();

            $tabla = 'clientes';
            $columna = 'id';
            $valor = $id;
            return $cliente->eliminarCliente($tabla, $columna, $valor);
           
        }
    }