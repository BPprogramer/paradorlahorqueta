<?php

 
    require_once '../controllers/CreditoController.php';
    require_once '../models/Credito.php';
    require_once '../models/Conexion.php';

    class AjaxTablaCreditos{
        public function mostrarTablaCreditos(){
          
        
            $creditos = CreditoController::consultarCreditos();
            
            
            
            $i=0;
            
            
      
            $datoJson = '{
                "data": [';
                    foreach($creditos as $key=>$credito){
                     
                        
                        if($credito['deuda']>0){
                            $deuda = "<div class='btn btn-warning text-bold'>$".number_format($credito['deuda'])."</div>";
                        }else{
                            $deuda = "<div'>$".number_format($credito['deuda'])."</div>";
                        }
                       
                        $i++;
                       
                    
                        $botones = "<div>";
                       
                        $botones .= "<button class='btn btn-primary btnInfoCredito' codigoVenta='".$credito['codigo_venta']."' style='margin-right:20px' data-toggle='modal' data-target='#infoCredito'><i class='fa fa-search' ></i></button>";
                        $botones .= "<button class='btn btn-danger btnPagarCredito' deuda='".$credito['deuda']."' idCredito='".$credito['id']."'   data-toggle='modal' data-target='#modalPagarCredito'><i class='fa fa-credit-card'  </i></button>";
                        $botones .= "</div>";
                        
                        
                        $datoJson.= '[
                                "'.$i.'",
                                "'.$credito['codigo_venta'].'",
                                "'.$credito['nombre_cliente'].'",
                              
                                "'.$credito['total'].'",

                                "'.$deuda.'",
                        
                             
                                "'.$botones.'"
                        ]';
                        if($key != count($creditos)-1){
                            $datoJson.=",";
                        }
                    }
          
            $datoJson.=  ']}';

            echo $datoJson;
        }

    }

    $cliente = new AjaxTablaCreditos();
    $cliente->mostrarTablaCreditos();