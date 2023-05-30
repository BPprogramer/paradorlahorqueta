<?php

    require_once '../controllers/ProveedorController.php';
    require_once '../models/Proveedores.php';

    class AjaxTablaProveedores{
        public function mostrarTablaProveedores(){
        
            $proveedores = ProveedorController::consultarProveedores();
          
        
            $i=0;
            
    
      
            $datoJson = '{
                "data": [';
                    foreach($proveedores as $key=>$proveedor){
                        // $credito_cliente = CreditoController::creditoIndex($cliente['id']);
                     
                        // if($credito_cliente['total_deuda']>0){
                        //     $deuda_cliente = $credito_cliente['total_deuda'];
                        //     $deuda = "<div class='btn btn-warning text-bold total_deuda_cliente' >$".number_format($credito_cliente['total_deuda'])."</div>";
                        // }else{
                        //     $deuda_cliente = 0;
                        //     $deuda = "<div class='total_deuda_cliente'>$".number_format($credito_cliente['total_deuda'])."</div>";
                        // }
                       
                        $i++;
                       
                    
                        $botones = "<div>";
                       
                        $botones .= "<button class='btn btn-warning btnEditarProveedor' idProveedor='".$proveedor['id']."' style='margin-right:20px' data-toggle='modal' data-target='#editarProveedor'><i class='fa fa-pencil' ></i></button>";
                        $botones .= "<button class='btn btn-danger btnEliminarProveedor'   idProveedor='".$proveedor['id']."'  data-toggle='moda' data-target='#modalEliminarProveedor'><i class='fa fa-times'  </i></button>";
                        $botones .= "</div>";
                        
                        
                        $datoJson.= '[
                                "'.$i.'",
                                "'.$proveedor['nombre'].'",
                                "'.$proveedor['telefono'].'",
                                "'.$proveedor['direccion'].'", 
                                "'.$botones.'"
                        ]';
                        if($key != count($proveedores)-1){
                            $datoJson.=",";
                        }
                    }
          
            $datoJson.=  ']}';
               
            echo $datoJson;
         }

    }

    $cliente = new AjaxTablaProveedores();
    $cliente->mostrarTablaProveedores();