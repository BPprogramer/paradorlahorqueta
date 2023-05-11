<?php 


    class InicioController{
        public static function inicio(){
            $datos_inicio = [];

            //suma total de todas las ventas
           //$ventas = Ventas::ventas();
            $total_ventas = Ventas::sumaPrecios('total');
            $total_costos = Ventas::sumaPrecios('total_costo');
            $creditos = Credito::totalCreditos();
     
           
     
            // foreach($ventas as $venta){
            //     $total_ventas+=$venta['total'];
            //     $productos = json_decode($venta['productos']);
           
                
            //     foreach($productos as $producto){
              
            //         $total_neto +=  $producto->precio_compra*$producto->cantidad;
            //     }
            // }
        
            $datos_inicio['total_ventas'] = number_format($total_ventas['total_suma'],2);
            $datos_inicio['total_costo'] = number_format($total_costos['total_suma'],2);
            $datos_inicio['ganancia'] = number_format($total_ventas['total_suma']-$total_costos['total_suma'],2);
            $datos_inicio['creditos'] = number_format($creditos['total_creditos'],2);
            $datos_inicio['ventas_sin_creditos'] = number_format($total_ventas['total_suma']-$creditos['total_creditos'],2);
            $datos_inicio['ganancias_sin_creditos'] = number_format($total_ventas['total_suma']-$total_costos['total_suma']-$creditos['total_creditos'],2);

            // $datos_inicio['total_neto'] = number_format($total_neto,2);
            // $datos_inicio['ganancia'] = number_format($total_ventas-$total_neto,2);

            // //todas las categorias
            // $categorias = Categorias::consultarCategorias('categorias',null, null);
            // $total_categorias = count($categorias);
            
            // $datos_inicio['total_categorias'] =$total_categorias;

            // //todos los clientes
            // $clientes = Clientes::consultarClientes('clientes', null, null);
            // $total_clientes = count($clientes);

            // $datos_inicio['total_clientes'] = $total_clientes;

            // //todos los productos
            // $productos = Productos::consultarProductos('productos',null, null);
            // $total_productos = count($productos);

            // $datos_inicio['total_productos'] = $total_productos;



            return $datos_inicio;
            
        }
    }