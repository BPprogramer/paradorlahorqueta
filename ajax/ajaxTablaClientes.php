<?php

    require_once '../controllers/ClienteController.php';
    require_once '../controllers/CreditoController.php';
    require_once '../models/Credito.php';

    class AjaxTablaClientes{
        public function mostrarTablaClientes(){
            $clientes = ClienteController::consultarClientes(null, null);
            
            $i=0;
            
            
      
            $datoJson = '{
                "data": [';
                    foreach($clientes as $key=>$cliente){
                        $credito_cliente = CreditoController::creditoIndex($cliente['id']);
                     
                        if($credito_cliente['total_deuda']>0){
                            $deuda_cliente = $credito_cliente['total_deuda'];
                            $deuda = "<div class='btn btn-warning text-bold total_deuda_cliente' >$".number_format($credito_cliente['total_deuda'])."</div>";
                        }else{
                            $deuda_cliente = 0;
                            $deuda = "<div class='total_deuda_cliente'>$".number_format($credito_cliente['total_deuda'])."</div>";
                        }
                       
                        $i++;
                       
                    
                        $botones = "<div>";
                       
                        $botones .= "<button class='btn btn-warning btnEditarCliente' idCliente='".$cliente['id']."' style='margin-right:20px' data-toggle='modal' data-target='#editarCliente'><i class='fa fa-pencil' ></i></button>";
                        $botones .= "<button class='btn btn-danger btnEliminarCliente' deuda_cl ='".$deuda_cliente."'  idCliente='".$cliente['id']."'  data-toggle='moda' data-target='#modalEliminarCliente'><i class='fa fa-times'  </i></button>";
                        $botones .= "</div>";
                       /*  $correo = $cliente['correo'];
                        if(strlen($correo)==0){
                            $correo = 'no especifica';
                        } */
                        
                        
                        $datoJson.= '[
                                "'.$i.'",
                                "'.$cliente['nombre'].'",
                                "'.$cliente['telefono'].'",
                                "'.$cliente['direccion'].'",
                                "'.$deuda.'",
                                 "'.$botones.'"
                        ]';
                        if($key != count($clientes)-1){
                            $datoJson.=",";
                        }
                    }
          
            $datoJson.=  ']}';

            echo $datoJson;
        }

    }

    $cliente = new AjaxTablaClientes();
    $cliente->mostrarTablaClientes();