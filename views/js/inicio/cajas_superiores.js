
$(document).ready(function(){
    if($('.inicio').length>0){
        datosInicio();
    }

    function datosInicio(){
        $.ajax({
            url:'ajax/AjaxInicio.php',
            dataType:'json',
            success:function(req){
                
                totalVentas(req['total_ventas']);
                totalCostos(req['total_costo']);
                totalGanancia(req['ganancia']);
                totalFiados(req['creditos'])
                totalVentasSinCreditos(req['ventas_sin_creditos']);
                totalGanaciasSinCreditos(req['ganancias_sin_creditos']);
              
            },
            error:function(error){
                console.log(error.responseText)
            }
        })
    }
    function totalVentas(info){
        $('#total_ventas').html(info);
    }
    function totalCostos(info){
        $('#total_costo').html(info);
    }
    function totalGanancia(info){
        $('#total_ganancia').html(info);
    }
    function totalFiados(info){
        
        $('#total_creditos').html(info);
    }
    function totalVentasSinCreditos(info){
        $('#total_ventas_sin_creditos').html(info);
    }
    function totalGanaciasSinCreditos(info){
        $('#total_ganancias_sin_creditos').html(info);
    }

})


