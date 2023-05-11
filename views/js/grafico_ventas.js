
if($('.grafico_ventas_reporte').length>0){

    const colores_hexa = ['#f56954','#00a65a', '#f39c12','#00c0ef','#3c8dbc','#a9acb6','#1E90FF','#006400', '#FF0000', '#8A2BE2'];
    const colores_text = ['red','green', 'yellow','aqua','blue','muted', 'primary', 'success', 'danger','purple',];
    let array_objetos_producto = []

    $('.data_date').ready(function(){
        
        const fecha_inicial = $('#data_date_in').val();
        const fecha_final = $('#data_date_fin').val();
        console.log(fecha_inicial)
        console.log(fecha_final)
        // const venticas = $.parseJSON(ventas); 

        // console.log(venticas)
        // mostrarCajasSuperiores(ventas)
     
      
    });
    function mostrarCajasSuperiores(ventas){
        //console.log(ventas)
        const ventas_array = $.parseJSON(ventas); //pasamos de JSON a array
        let total_ventas = 0;
        let total_precio_compra = 0;
        ventas_array.forEach(venta=>{
          
            
            total_ventas += (venta['total']);
            let productos = $.parseJSON(venta['productos']);
            productos.forEach(producto=>{
                total_precio_compra += producto['precio_compra']*producto['cantidad'];
            })
            
           
        })
        let ganancia = total_ventas-total_precio_compra;
        total_ventas = total_ventas.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        total_precio_compra = total_precio_compra.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
        ganancia = ganancia.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
    
      

        $('#total_ventas').html(total_ventas);
        $('#reporte_total_precio_compra').html(total_precio_compra);
        $('#reporte_total_ganancia').html(ganancia);

       
       
    }

   
}
   