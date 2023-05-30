<?php 
    require_once 'Conexion.php';



    class Clientes{
        public static function consultarClientes($tabla, $columna, $valor){
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
        public function agregarCliente($tabla, $datos){

            $stmt =  Conexion::conectarDB()->prepare("INSERT INTO   $tabla (nombre,cedula, telefono, direccion, correo) VALUES (:nombre, :cedula,  :telefono, :direccion, :correo)");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $datos['cedula'],  PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos['telefono'],  PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos['direccion'],  PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos['correo'],  PDO::PARAM_STR);
           
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
        public function editarCliente($tabla, $datos){
    
            $stmt =  Conexion::conectarDB()->prepare("UPDATE $tabla  SET nombre=:nombre, cedula=:cedula, telefono=:telefono, direccion=:direccion , correo=:correo WHERE id=:id");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $datos['cedula'],  PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos['telefono'],  PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos['direccion'],  PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos['correo'],  PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'],  PDO::PARAM_STR);
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
        public function eliminarCliente($tabla, $columna, $valor){
            $stmt = Conexion::conectarDB()->prepare("DELETE FROM $tabla WHERE $columna = :$columna");
            $stmt->bindParam(":".$columna, $valor, PDO::PARAM_STR);
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
          
        //actualizar las compras del cliente cuando hace una compra
        public function actualizarCliente($tabla, $columna, $valor1, $valor2){
            
            $stmt = Conexion::conectarDB()->prepare("UPDATE $tabla SET $columna = :$columna  WHERE id= :id");
            
            $stmt->bindParam(":".$columna, $valor1, PDO::PARAM_STR);
            $stmt->bindParam(":id",$valor2, PDO::PARAM_INT );
         
            // return $stmt;
            // return ['tabla'=>$tabla, 'columna1'=>$columna1, 'valor1'=>$valor1,'valor2'=>intval($valor2)];
            //return 'codigo';
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
          

        }
    }
