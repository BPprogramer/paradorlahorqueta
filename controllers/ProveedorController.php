<?php 

    // class ProveedorController{
    //     public static function guardarProveedor(){
    //         $proveedor = new Proveedores();
    //         $nombre = $_POST['nombre'];
    //         $telefono = $_POST['telefono'];
    //         $direccion = $_POST['direccion'];

    //         $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
    //         $parttern_telefono = '/^[()\-0-9 ]+$/';
    //         $parttern_direccion = '/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';

    //         if(preg_match($parttern_2,$nombre ) && 
    //         preg_match( $parttern_telefono,$telefono) &&
    //         preg_match( $parttern_direccion,$direccion)){
                
    //             $tabla = 'proveedores';
    //             $datos = array('nombre'=>$nombre, 'telefono'=>$telefono, 'direccion'=>$direccion);
            
               
    //             return $proveedor->guardarProveedor($datos);
                
    //         }else{
    //             return 'no-validate';
    //         }
    //     }

    //     public static function consultarProveedores($columna=null, $valor=null){
 
    //         $respuesta = Proveedores::consultarProveedores('proveedores', $columna, $valor);
    //         return $respuesta;
    //     }

    //     public static function editarProveedor(){
    //         $id = filter_var($_POST['id_editar_proveedor'], FILTER_VALIDATE_INT);
    //         if(!$id){
    //             return ;
    //         }
          
    //         $nombre = $_POST['editar_nombre'];
    //         $telefono = $_POST['editar_telefono'];
    //         $direccion = $_POST['editar_direccion'];
          
    //         $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
    //         $parttern_telefono = '/^[()\-0-9 ]+$/';
    //         $parttern_direccion = '/^[#\.\,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
           

    //         if(preg_match($parttern_2, $nombre ) && 
    //             preg_match( $parttern_telefono, $telefono) &&
    //             preg_match( $parttern_direccion, $direccion)){
                    
    //                 $tabla = 'proveedores';
    //                 $datos = array('id'=>$id, 'nombre'=>$nombre,  'telefono'=>$telefono, 'direccion'=>$direccion);
    //                 $proveedor = new Proveedores();
              
    //                 return $proveedor->editarProveedor($datos);
                    
    //         }else{
    //             return 'no_validate';
    //         }
    //     }
    //     public static function eliminarProveedor(){
    //         $id = filter_var($_POST['id_eliminar_proveedor'], FILTER_VALIDATE_INT);
    //         if(!$id){
    //             return 'error';
    //         }
           
           
    //         $proveedor = new Proveedores();
    //         $valor = $id;
    //         return $proveedor->eliminarProveedor($valor);
           
    //     }
    // }