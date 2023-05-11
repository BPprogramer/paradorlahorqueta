<?php 


	class UsuarioController{

		public function login(){
            if(isset($_POST['usuario'])){
                $parttern = '/^[-a-zA-Z0-9]+$/';
                if(preg_match($parttern, $_POST['usuario']) && preg_match($parttern, $_POST['password'])){
                    $tabla = 'usuarios';
                    $columna = 'usuario';
                    $usuario = $_POST['usuario'];
                    $password = $_POST['password'];
                    $password = crypt($password, '$2a$07$usesomesillystringforsalt$');

                    $respuesta = Usuarios::consultarUsuario($tabla, $columna, $usuario);
                 
                    if($respuesta){
                        if($respuesta['usuario']==$usuario && $respuesta['password']==$password ){
                            if($respuesta['estado']==1){
                                $_SESSION['login'] = true;
                                $_SESSION['id'] = $respuesta["id"];
                                $_SESSION['nombre'] = $respuesta["nombre"];
                                $_SESSION['usuario'] = $respuesta["usuario"];
                                $_SESSION['foto'] = $respuesta["foto"];
                                $_SESSION['perfil'] = $respuesta["perfil"];

                                //registrar la fecha exacta del login para almacenar enla BD para el ultimo login
                                date_default_timezone_set('America/Bogota');
                                $fecha = date('Y-m-d');
                                $hora = date('H:i:s');
                                $fechaUltimoLogin = $fecha.' '.$hora;
                                $tabla = 'usuarios';
                                $columnaId = 'id';
                                $valorId = $_SESSION['id'];
                                $columnaUltimoLogin = 'ultimo_login';
                                $valorUltimoLogin = $fechaUltimoLogin;
                                $usuario = new Usuarios();
                                $respuesta = $usuario->editarDatosUsuario($tabla , $columnaUltimoLogin, $valorUltimoLogin, $columnaId, $valorId);
                                if($respuesta == 'ok'){
                                 
                                   echo "<script>window.location = 'inicio'</script>";
                                }

                              
                               
                            }else{
                                echo '<br><div class="alert alert-danger">Usuario no activado, comuniquese con el administrador</div>';
                            }
                          
                        }else{
                            echo '<br><div class="alert alert-danger">Contraseña incorrecta</div>';
                        }
                    }else{
                        echo '<br><div class="alert alert-danger">Usurio no Registrado</div>';
                    }
                   
                }
            }
        }

        public static function registrarUsuario(){
       

            if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['nombre'])){

                $nombre = trim($_POST['nombre']);
                $usuario = trim($_POST['usuario']);
                $password = $_POST['password'];
                $perfil = $_POST['perfil'] ?? '';
                $perfiles = ['vendedor', 'administrador'];
                if(!(in_array($perfil, $perfiles))){
                      
                    echo "<script> 
                    Swal.fire({
                    
                        title: 'Todos los campos son obligatorios o los caracteres no son validos',
                
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                    
                        confirmButtonText: 'Cerrar'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'usuarios'
                            }
                        })
                
                </script>";
                    return;
                }
                $parttern_1 = '/^[-a-zA-Z0-9]+$/';
                $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
              
                if(  preg_match($parttern_2, $nombre) && preg_match($parttern_1, $password) && preg_match($parttern_1, $usuario) &&  preg_match($parttern_1, $perfil)){
                  
                    $ruta = "";
                    if(($_FILES['imagen']['tmp_name']) !== ""){
                         list($width, $height) = getimagesize($_FILES['imagen']['tmp_name']);
                         $newWidth = 500;
                         $newHeight = 500;

                         $directorio = "views/img/usuarios/fotos/";
                         if(!is_dir($directorio)){
                             mkdir($directorio);
                         }
                      
                         $nombre_imagen = md5(uniqid(rand(),true));
                       
                    
                        if($_FILES['imagen']['type'] == "image/jpeg"){
                            
                            //guardamos la imagen 
                           
                            $ruta = $directorio.$nombre_imagen.".jpg";
                             $img_origen = imagecreatefromjpeg($_FILES["imagen"]["tmp_name"]); ///////
                            $img_destino = imagecreatetruecolor($newWidth, $newHeight);             
                            imagecopyresized($img_destino,$img_origen, 0, 0, 0,0, $newWidth, $newHeight,$width, $height);
                            imagejpeg($img_destino, $ruta);
                        
                        }
                        if($_FILES['imagen']['type'] == "image/png"){
                            
                            //guardamos la imagen 
                           
                            $ruta = $directorio.$nombre_imagen.".png";
                             $img_origen = imagecreatefrompng($_FILES["imagen"]["tmp_name"]); ///////
                            $img_destino = imagecreatetruecolor($newWidth, $newHeight);             
                            imagecopyresized($img_destino,$img_origen, 0, 0, 0,0, $newWidth, $newHeight,$width, $height);
                            imagejpeg($img_destino, $ruta);
                        
                        }
                    }
               
      
                    $tabla = 'usuarios';
            
                    //encriptar password
                    $password = crypt($password, '$2a$07$usesomesillystringforsalt$');

                    $datos = array("nombre"=>$nombre, "usuario"=>$usuario, "password"=> $password, "perfil"=>$perfil, "foto"=>$ruta);
                    $respuesta = Usuarios::registrarUsuario($tabla, $datos);
                    
                    if($respuesta=='ok'){
                        
                        echo "<script> 
                        Swal.fire({
                        
                            title: 'Usuario Almacenado',
                    
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                        
                            confirmButtonText: 'Cerrar'
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'usuarios'
                                }
                            })
                            
                        </script>";
                    } 
                    
                  
                }else{
                    echo "<script> 
                        Swal.fire({
                        
                            title: 'Todos los campos son obligatorios o los caracteres no son validos',
                    
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                        
                            confirmButtonText: 'Cerrar'
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'usuarios'
                                }
                            })
                    
                    </script>";
                }
            }
        }

        public  function mostrarUsuarios($tabla, $columna, $valor){

            $usuarios = Usuarios::consultarUsuario($tabla, $columna, $valor);
            return $usuarios;
        }

        public function editarUsuario(){
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['nombreEdit'])){
                $nombre = trim($_POST['nombreEdit']);
                $usuario = trim($_POST['usuario']);
              
                $perfil = $_POST['perfil'] ?? '';
                $perfiles = ['vendedor', 'administrador'];
                if(!(in_array($perfil, $perfiles))){
                      
                    echo "<script> 
                    Swal.fire({
                    
                        title: 'hubo un problema en el perfil, intenta nuevamente',
                
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                    
                        confirmButtonText: 'Cerrar'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'usuarios'
                            }
                        })
                        
                    </script>";
                    return;
                }
                $parttern_1 = '/^[-a-zA-Z0-9]+$/';
                $parttern_2 = '/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/';
              
                if( preg_match($parttern_2, $nombre)   &&  preg_match($parttern_1, $perfil) && preg_match($parttern_1, $usuario)){
                    $ruta =$_POST['fotoActual'];
                    
                    if(($_FILES['imagenEdit']['tmp_name']) !== ""){
                        list($width, $height) = getimagesize($_FILES['imagenEdit']['tmp_name']);
                        $newWidth = 500;
                        $newHeight = 500;
                        
                      
                        $directorio = "views/img/usuarios/fotos/";
                        if(!is_dir($directorio)){
                            mkdir($directorio);
                        }
                        if(!empty($_POST["fotoActual"])){
                            unlink($_POST['fotoActual']);
                        }
                        
                        
                        $nombre_imagen = md5(uniqid(rand(),true));
                        if($_FILES['imagenEdit']['type'] == "image/jpeg"){
                            
                            //guardamos la imagen 
                          
                            $ruta = $directorio.$nombre_imagen.".jpg";
                            $img_origen = imagecreatefromjpeg($_FILES["imagenEdit"]["tmp_name"]); ///////
                            $img_destino = imagecreatetruecolor($newWidth, $newHeight);             
                            imagecopyresized($img_destino,$img_origen, 0, 0, 0,0, $newWidth, $newHeight,$width, $height);
                            imagejpeg($img_destino, $ruta);
                        
                        }
                        if($_FILES['imagenEdit']['type'] == "image/png"){
                            
                            //guardamos la imagen 
                          
                            $ruta = $directorio.$nombre_imagen.".png";
                            $img_origen = imagecreatefrompng($_FILES["imagenEdit"]["tmp_name"]); ///////
                            $img_destino = imagecreatetruecolor($newWidth, $newHeight);             
                            imagecopyresized($img_destino,$img_origen, 0, 0, 0,0, $newWidth, $newHeight,$width, $height);
                            imagejpeg($img_destino, $ruta);
                        
                        }
                    }
            

                    $tabla = "usuarios";
                    if($_POST['password']!=''){ //pasword viene con algo encripto la nueva contraseña sino guardo la que esta en elhidden oculto que es la actual
                        
                        //encriptar password
                        $password = $_POST['password'];
                        if(preg_match($parttern_1, $password)){
                            $password = crypt($password, '$2a$07$usesomesillystringforsalt$');
                        }else{
                            echo "<script> 
                            Swal.fire({
                            
                                title: 'El password solo acepta numeros y letras sin caracteres epeciales',
                        
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                            
                                confirmButtonText: 'Cerrar'
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = 'usuarios'
                                    }
                                })
                        
                            </script>";
                        }
                        
                    }else{
                        $password = $_POST['passwordActual'];
                    }

                    $datos = array("nombre"=>$nombre, "usuario"=>$usuario, "password"=> $password, "perfil"=>$perfil, "foto"=>$ruta, "id"=>$_POST["idUsuarioEditar"]);
                    $respuesta = Usuarios::editarUsuario($tabla, $datos);
                    if($respuesta=='ok'){
                        
                        echo "<script> 
                        Swal.fire({
                        
                            title: 'Usuario Editado',
                    
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                        
                            confirmButtonText: 'Cerrar'
                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'usuarios'
                                }
                            })
                            
                        </script>";
                    } 

                }else{
                    echo "<script> 
                    Swal.fire({
                    
                        title: 'el nombre y el usuario son obligatorios, no debe llevar caracters especiles, solo tildes y ñ',
                
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                    
                        confirmButtonText: 'Cerrar'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'usuarios'
                            }
                        })
                
                    </script>";
                }
            }
        }

        /* Elñiminar Usuario */

        public  function eliminarUsuario(){
            if(isset($_GET['id'])){
                $tabla = "usuarios";
                $columnaId = 'id';
                $valorId = $_GET['id'];

                if($_GET['path'] !=""){
                    unlink($_GET['path']);
                }

                $usuario = new Usuarios();
                $respuesta = $usuario->eliminarUsuario('usuarios', 'id', $valorId);
                if($respuesta=='ok'){
                    echo "<script> 
                    Swal.fire({
                    
                        title: 'Usuario eliminado Correctamente',
                        type: 'success',    
                        icon: 'success',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                    
                        confirmButtonText: 'Cerrar'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'usuarios'
                            }
                        })
                
                    </script>";
                }
            }
        }
        

     
    }


       
        
      
		
 	
