<?php 

require_once 'Conexion.php';
    class Categorias{
        public function crearCategoria($tabla, $valor){ 
            $stmt = Conexion::conectarDB()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");
            $stmt->bindParam(":nombre", $valor, PDO::PARAM_STR);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
        }
        public function editarCategoria($tabla, $datos){ 
            $stmt = Conexion::conectarDB()->prepare("UPDATE  $tabla SET nombre = :nombre WHERE id=:id");
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'], PDO::PARAM_STR);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
        }
        public static function consultarCategorias($tabla, $columna, $valor){
            if($columna != null){
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");
                $stmt->bindParam(":".$columna,$valor, PDO::PARAM_STR);
                $stmt->execute();
                
                return $stmt->fetch(); 
            }else{
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                $resultado = $stmt->fetchAll();
                return $resultado; 
            }

        }
        public function eliminarCategoria($tabla,$columna, $valor){
            $stmt = Conexion::conectarDB()->prepare("DELETE FROM $tabla WHERE $columna= :$columna");
            $stmt->bindParam(':'.$columna, $valor, PDO::PARAM_STR);
            if($stmt->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }