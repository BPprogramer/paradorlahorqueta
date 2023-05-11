
<?php 
    
    class ReporteVentasController{
        public static function consultarDatosVentas(){
            $respuesta = []; 

            $total_ventas = Ventas::consultarVentasPorFecha($_POST, 'total');
           
            $total_costos = Ventas::consultarVentasPorFecha($_POST, 'total_costo');
            $total_deuda = Ventas::consultarVentasPorFecha($_POST, 'deuda');
            $respuesta['total_ventas'] = $total_ventas['total'];
            $respuesta['total_costos'] = $total_costos['total'];
            $respuesta['ganancia'] = $total_ventas['total']-$total_costos['total'];
            $respuesta['deuda'] = $total_deuda['total'];
            $respuesta['ventas_sin_deuda'] = $total_ventas['total']-$total_deuda['total'];
            $respuesta['ganancia_sin_deuda'] = $total_ventas['total']-$total_deuda['total']-$total_costos['total'];
          

            return $respuesta;
        }
    }