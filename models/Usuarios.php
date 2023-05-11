
<?php
	
    require_once 'Conexion.php';
	class Usuarios{
        public static function consultarUsuario($tabla, $columna, $valor){
            if($columna){
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna ");
                $stmt-> bindParam(":".$columna, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }else{
                $stmt = Conexion::conectarDB()->prepare("SELECT * FROM usuarios");
                $stmt->execute();
                $resultado = $stmt->fetchAll();
                return  $resultado;
            }
   
         
        }

        public static function registrarUsuario($tabla, $datos){
            $stmt =  Conexion::conectarDB()->prepare("INSERT INTO   $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos['usuario'],  PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos['password'],  PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $datos['perfil'],  PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datos['foto'],  PDO::PARAM_STR);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
   
        }

      /*   public static function consultarUsuarios($tabla){
            $stmt = Conexion::conectarDB()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            return  $resultado;
        }
      */
        public static function editarUsuario($tabla, $datos){
            $stmt = Conexion::conectarDB()->prepare("UPDATE $tabla SET nombre =:nombre, usuario=:usuario, password=:password, perfil = :perfil, foto=:foto WHERE id= :id");
            $stmt->bindParam(":nombre", $datos['nombre'],  PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos['password'],  PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos['usuario'],  PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $datos['perfil'],  PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datos['foto'],  PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'],  PDO::PARAM_STR);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }

        }

        public  function editarDatosUsuario($tabla, $columna1, $valor1, $columna2, $valor2){
            $stmt = Conexion::conectarDB()->prepare("UPDATE $tabla SET $columna1 =:$columna1  WHERE $columna2= :$columna2");
          
            $stmt->bindParam(":".$columna1, $valor1, PDO::PARAM_STR );
            $stmt->bindParam(":".$columna2, $valor2, PDO::PARAM_STR );
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
          

        }

        public function eliminarUsuario($tabla, $columna, $valor){
            $stmt = Conexion::conectarDB()->prepare("DELETE FROM $tabla WHERE $columna =:$columna");
            $stmt->bindParam(":".$columna, $valor, PDO::PARAM_STR);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
        }
     
	}

  