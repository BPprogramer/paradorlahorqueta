
if($('.grafico_ventas_reporte').length>0){

    const colores_hexa = ['#f56954','#00a65a', '#f39c12','#00c0ef','#3c8dbc','#a9acb6','#1E90FF','#006400', '#FF0000', '#8A2BE2'];
    const colores_text = ['red','green', 'yellow','aqua','blue','muted', 'primary', 'success', 'danger','purple',];
    let array_objetos_producto = []

    $('.data_date_in').ready(function(){

        const fecha_inicial = $('#data_date_in').val();
        const fecha_final = $('#data_date_fin').val();

        consultarDatosVentas(fecha_inicial+' 00:00:00', fecha_final+' 23:59:59');
        // const venticas = $.parseJSON(ventas); 

        // console.log(venticas)
        // mostrarCajasSuperiores(ventas)
     
      
    });

    function consultarDatosVentas(fecha_inicial, fecha_final){
  
        const datos = new FormData();
        datos.append('fecha_inicial',fecha_inicial);
        datos.append('fecha_final',fecha_final);

        $.ajax({
            url : "ajax/AjaxReporteVentas.php",
            method: 'POST',
            data: datos,
            cache:false,
            contentType:false,
            processData: false,
            dataType: "json",
            success:function(req){
              console.log(req)
                mostrarCajasSuperiores(req);
            },
            error:function(error){
                console.log(error.responseText)
            }
        })
    }
    function mostrarCajasSuperiores(datos){
        //console.log(ventas)

      
        const total_ventas = datos['total_ventas'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        const total_costos = datos['total_costos'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        const ganancia = datos['ganancia'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        const deuda = datos['deuda'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        const ganancia_sin_deuda = datos['ganancia_sin_deuda'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        const ventas_sin_deuda = datos['ventas_sin_deuda'].toLocaleString('en-US', {style: 'currency', currency: 'USD'});
    
    
      

        $('#reporte_total_ventas').html(total_ventas);
        $('#reporte_ganancia').html(ganancia);
        $('#reporte_fiado').html(deuda);
        $('#reporte_ventas_sin_fiados').html(ventas_sin_deuda);
        $('#reporte_ganancias_sin_creditos').html(ganancia_sin_deuda);
        $('#reporte_costo').html(total_costos);

       
       
    }

   
}
   