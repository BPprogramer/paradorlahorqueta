
<?php 

//     require_once '../controllers/VentasController.php';

//     class AjaxTablaAministrarVentas{
//         public  function mostrarTablaVentas(){
//             $i=0;
//             $ventas = VentasController::consultarVentas(null, null, null);
//             // echo json_encode($ventas);
     
//             $datoJson = '{
//                 "data": [';
//                     foreach($ventas as $key=>$venta){
//                         $i++;
                       
//                         $botones = "<div class='btn-group'>";
//                         $botones .= " <button class='btn btn-info'><i class='fa fa-print'></i></button>";
//                         $botones .= "<button  class='btn btn-warning btn_editar_venta' id_venta = '".$venta['id']."'><i class='fa fa-pencil'></i></button>";
//                         $botones .= "<button class='btn btn-danger'><i class='fa fa-times'></i></button>";
//                         $botones .= "</div>";
                       
                        
//                         $datoJson.= '[
//                                 "'.$i.'",
//                                 "'.$venta['codigo'].'",
//                                 "'.$venta['nombre_cliente'].'",
//                                 "'.$venta['nombre_vendedor'].'",
//                                 "'.$venta['metodo_pago'].'",
//                                 "'.$venta['neto'].'",
//                                 "'.$venta['total'].'",
//                                 "'.$venta['fecha'].'",
//                                 "'.$botones.'"
//                         ]';
//                         if($key != count($ventas)-1){
//                             $datoJson.=",";
//                         }
//                     }
          
//             $datoJson.=  ']}';
           
//             echo $datoJson;
//         }
       
//     }

//    $ventas = new AjaxTablaAministrarVentas();
//    $ventas->mostrarTablaVentas();