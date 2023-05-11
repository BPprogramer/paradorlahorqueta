<?php 

    class CategoriasController{

        public static function crearCategoria(){
     

           // echo '<script>console.log("entrasndo a post")</script>';
            if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['nombre'])){
           
                echo '<script>console.log("entrasndo a post")</script>';
                $nombre = trim($_POST['nombre']);
                $categoria = new Categorias();
                if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)){
                    $tabla = 'categorias';
                    
                    $valor = $nombre;
                  
                    $respuesta = $categoria->crearCategoria($tabla,  $valor);
                    if($respuesta == 'ok'){
                   
                        echo "<script>
                                Swal.fire({

                                    title:'categoria Almacenada Correctamente',
                                    type: 'success',
                                    icon:'success',
                                    showConfirmButton:true,
                                    confirmButtontext: 'cerrar',

                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = 'categorias'
                                        }
                                    })
                              
                    </script>";
                    }
                }else{
                    echo "<script>
                            Swal.fire({
                                title:'El nombre de la categoría no puede ir vacia ni llevar caracteres especiales',
                                type: 'error',
                                icon:'error',
                                showConfirmButton:true,
                                confirmButtontext: 'cerrar',

                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'categorias'
                                }
                            })
                    </script>";
                }
            }
        }

        public static function consultarCategorias($columna, $valor){
            $categorias = Categorias::consultarCategorias('categorias',$columna, $valor);
            return $categorias;
        }
        public static function editarCategoria(){
         
            if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['nombreEditar'])){
       
                $nombre = ($_POST['nombreEditar']);
                
                
                $categoria = new Categorias();
                if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)){
                    $tabla = 'categorias';
                    
                  
                    $id = $_POST['idEditarCategoria'];
                    $datos = ['nombre'=>$nombre, 'id'=>$id];
                   
                    $respuesta = $categoria->editarCategoria($tabla,  $datos);
                    if($respuesta == 'ok'){
                   
                        echo "<script>
                                Swal.fire({

                                    title:'categoria Editada Correctamente',
                                    type: 'success',
                                    icon:'success',
                                    showConfirmButton:true,
                                    confirmButtontext: 'cerrar',

                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = 'categorias'
                                        }
                                    })
                              
                    </script>";
                    }
                }else{
                    echo "<script>
                            Swal.fire({
                                title:'El nombre de la categoría no puede ir vacia ni llevar caracteres especiales',
                                type: 'error',
                                icon:'error',
                                showConfirmButton:true,
                                confirmButtontext: 'cerrar',

                            }).then((result)=>{
                                if(result.value){
                                    window.location = 'categorias'
                                }
                            })
                    </script>";
                }
            }
        }

        public static function eliminarCategoria(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
                $tabla = "categorias";
                $valor = $id;

                $categoria = new Categorias();
                $respuesta = $categoria->eliminarCategoria($tabla,'id', $valor);
                if($respuesta=='success'){
                    echo "<script>
                    Swal.fire({

                        title:'Categoria Eliminada Correctamente',
                        type: 'success',
                        icon:'success',
                        showConfirmButton:true,
                        confirmButtontext: 'cerrar',

                        }).then((result)=>{
                            if(result.value){
                                window.location = 'categorias'
                            }
                        })
                  
        </script>";
                }
            }
            
            
        }
    }
 