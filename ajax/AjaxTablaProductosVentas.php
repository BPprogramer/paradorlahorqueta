<?php

    require_once '../controllers/ProductosController.php';
    require_once '../models/Productos.php';




    class AjaxTablaProductosVentas{
        public function mostrarTablaProductosVentas(){

            $productos = ProductosController::consultarProductos(null, null);
            $i=0;
            
            
      
            $datoJson = '{
                "data": [';
                    foreach($productos as $key=>$producto){
                        $i++;
                        $imagen = "<img class='img-thumbmail' style='width:40px' src='".$producto['imagen']."'>";
                       
                     
                      
                            $stock = "<button class='btn btn-secondary stock stock_".$producto['id']."'>".$producto['stock']."</button>";
                    
                            $precio = "<button class='btn btn-success'>$".number_format($producto['precio_venta'])."</button>";
                    
                
                      
                        $botones = "<div class='btn-group'> ";
                        $botones .= "<button class='btn btn-primary agregarProducto recuperarBoton'  idProducto='".$producto['id']."'>Agregar</button>";
                        $botones .= "</div>";
                        $datoJson.= '[
                                "'.$i.'",
                                "'.$imagen.'",
                                "'.$producto['descripcion'].'",
                                "'.$precio.'",
                                "'.$stock.'",
                                "'.$botones.'"
                        ]';
                        if($key != count($productos)-1){
                            $datoJson.=",";
                        }
                    }
          
            $datoJson.=  ']}';

            echo $datoJson;
        }
    }

    $productos = new AjaxTablaProductosVentas();
    $productos->mostrarTablaProductosVentas();



  
