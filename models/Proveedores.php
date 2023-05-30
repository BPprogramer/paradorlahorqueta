<?php 
    require_once 'Conexion.php';
    class proveedores{
        public function guardarProveedor($datos){
            $stmt =  Conexion::conectarDB()->prepare("INSERT INTO  proveedores (nombre, telefono, direccion) VALUES (:nombre,  :telefono, :direccion)");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos['telefono'],  PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos['direccion'],  PDO::PARAM_STR);
           
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
        public static function consultarProveedores($tabla, $columna=null, $valor=null){
           
            if($columna){
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM $tabla  WHERE $columna = :$columna");
                $stmt->bindParam(":".$columna, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
                
               
            }else{
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM $tabla  ORDER BY id DESC");
                $stmt->execute();
                $resultado = $stmt->fetchAll();
                return  $resultado;
            }
        }
        public function editarProveedor($datos){
    
            $stmt =  Conexion::conectarDB()->prepare("UPDATE proveedores  SET nombre=:nombre, telefono=:telefono, direccion=:direccion WHERE id=:id");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos['telefono'],  PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos['direccion'],  PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'],  PDO::PARAM_STR);
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
        public function eliminarProveedor($valor){
            $columna = 'id';
            $stmt = Conexion::conectarDB()->prepare("DELETE FROM proveedores WHERE $columna = :$columna");
            $stmt->bindParam(":".$columna, $valor, PDO::PARAM_STR);
         
          
            try {
                if($stmt->execute()){
                    return 'success';
                }else{
                    return 'error';
                }
            } catch (PDOException $e) {
                // Captura la excepción y maneja el error
                return 'fk_unrestricted';
                // Realiza las acciones necesarias para manejar el error, como mostrar un mensaje al usuario o revertir cambios
            }
            
        }
       
    }