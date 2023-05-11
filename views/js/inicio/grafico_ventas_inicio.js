
if($('.grafico_ventas_inicio').length>0){

    const colores_hexa = ['#f56954','#00a65a', '#f39c12','#00c0ef','#3c8dbc','#a9acb6','#1E90FF','#006400', '#FF0000', '#8A2BE2'];
    const colores_text = ['red','green', 'yellow','aqua','blue','muted', 'primary', 'success', 'danger','purple',];
    let array_objetos_producto = []

    $('.data_date').ready(function(){
        
        const ventas = $('#data_date').val();
        //const venticas = $.parseJSON(ventas); 
        // Objeto para almacenar las sumas de precios por id
   
        // totalVentasPorVendedor(venticas);
        // totalComprasPorCliente(venticas)
        // consultaProductos();
   
        // mostrarGraficos(ventas);
        // tortaPieChart(ventas);
      
    });

//     function totalComprasPorCliente(ventas){
     
//         const precios_totales_por_id = {};
//         ventas.forEach(venta => {
//           if (precios_totales_por_id[venta['id_cliente']] === undefined) {
//             precios_totales_por_id[venta['id_cliente']] = venta['total'];
           
//           } else {
//             precios_totales_por_id[venta['id_cliente']] += venta['total'];
         
//           }
//         });
   
//         const arreglo_ids_precios = [];
//         for (const id in precios_totales_por_id) {
//           arreglo_ids_precios.push({ id_cliente: parseInt(id), precio_total: precios_totales_por_id[id] });
//         }
     

      
//           arreglo_ids_precios.forEach(index=>{
          
//           let id_cliente = index['id_cliente'];
//           let datos = new FormData();
//           datos.append('id_cliente', id_cliente)
//           $.ajax({
//               url:'ajax/AjaxClientes.php',
//               method:'POST',
//               async:false,
//               data: datos,
//               cache:false,
//               contentType:false,
//               processData:false,
//               dataType:'json',
//               success:function(req){
//                 if(req['nombre']==undefined){
//                     index.name = 'Anonimo';
//                 }else{
//                     index.name =req['nombre']
//                 }
                  
                  
                 
                  
//               },
//               error:function(error){
//                   console.log(error.responseText)
//               }
//           })
         
//         })
        
//       let array_data = [] 
 
//       arreglo_ids_precios.forEach(index=>{
//           array_data.push({y:index['name'], a:index['precio_total']})
//       });
//       //array_data.sort((a, b) => b.precio - a.precio); //aqui ordenamos el precio de mayor a menor por si mas delante tenemos muchos vendedores
//       console.log
//       clientesTop(array_data)
//     }
//     function clientesTop(data){
//         //BAR CHART}
    
//         let bar = new Morris.Bar({
//             element: 'bar-chart2',
//             resize: true,
//             data: data,
//             barColors: ['#00a65a'],
//             xkey: 'y',
//             ykeys: ['a'],
//             labels: ['compras'],
//             hideHover: 'auto',
//             preUnits: '$'
//         });
//     }
// 
/* 
    function totalVentasPorVendedor(ventas){
        
       
          const precios_totales_por_id = {};
          ventas.forEach(venta => {
            if (precios_totales_por_id[venta['id_vendedor']] === undefined) {
              precios_totales_por_id[venta['id_vendedor']] = venta['total'];
            } else {
              precios_totales_por_id[venta['id_vendedor']] += venta['total'];
            }
          });
     
          const arreglo_ids_precios = [];
          for (const id in precios_totales_por_id) {
            arreglo_ids_precios.push({ id_vendedor: parseInt(id), precio_total: precios_totales_por_id[id] });
          }


            arreglo_ids_precios.forEach(index=>{
            
            let id_vendedor = index['id_vendedor'];
            let datos = new FormData();
            datos.append('id_vendedor', id_vendedor)
            $.ajax({
                url:'ajax/AjaxUsuarios.php',
                method:'POST',
                async:false,
                data: datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(req){
                    if(req==undefined){
                      
                        index.name = 'Anonimo';
                    }else{
                        index.name =req
                    }
                   
                    
                },
                error:function(error){
                    console.log(error.responseText)
                }
            })
           
          })
          
        let array_data = [] 
   
        arreglo_ids_precios.forEach(index=>{
            array_data.push({y:index['name'], a:index['precio_total']})
        });
        //array_data.sort((a, b) => b.precio - a.precio); //aqui ordenamos el precio de mayor a menor por si mas delante tenemos muchos vendedores
       
        vendedoresTop(array_data)
      
       
    }

    function vendedoresTop(data){
       
     
        let bar = new Morris.Bar({
            element: 'bar-chart1',
            resize: true,
            data: data,
            barColors: ['#0af'],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['ventas'],
            hideHover: 'auto',
            preUnits: '$'
        });
    }
  
    function consultaProductos(){
            
        const datos = new FormData();
        datos.append('consultar_productos_desc', 'consultar_productos_desc');
        $.ajax({
            url:"ajax/AjaxProductos.php",
            method:'POST',
            data:datos,
            cache:false,
            processData:false,
            contentType:false,
            dataType:'json',
            success:function(req){
                listaProductosTop(req);
                listarPorcentajesTop(req);
            },
            error:function(error){
                console.log(error.responseText)
            }

        })
    }
    function listarPorcentajesTop(productos){
        const total_ventas = productos.reduce((suma, producto) => suma+producto['ventas'],0);
   
        for(let i = 0; i<5; i++){
            
            let porcenta_venta = (productos[i]['ventas']*100/total_ventas).toFixed(2);
            $('.productos_porcentajes').append(` 
                <li>
                    <a href="#"> 
                        <img class="img-thumbnail" src="${productos[i]['imagen']}" style="width:40px"> ${productos[i]['descripcion']}
                        <span class="pull-right text-${colores_text[i]}"><i class="fa fa-angle-down"></i> ${porcenta_venta}</span>
                    </a>
                </li>
            `);
          

        }

       
    }

    function listaProductosTop(productos){
        
        for(let i = 0; i<10; i++){
            $('.lista_productos_top').append(`<li><i class="fa fa-circle-o text-${colores_text[i]}"></i> ${productos[i]['descripcion']}</li>`);
            objeto_producto = {
                value    : productos[i]['ventas'],
                color    : colores_hexa[i],
                highlight: colores_hexa[i],
                label    : productos[i]['descripcion']
            }
            array_objetos_producto.push(objeto_producto)

        }
        tortaPieChart( array_objetos_producto)
    }
    function tortaPieChart(array_objetos_producto){
   
        // -------------
        // - PIE CHART -
        // -------------
        // Get context with jQuery - using jQuery's .get() method.
        let pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        let pieChart       = new Chart(pieChartCanvas);
        let PieData        = array_objetos_producto;
        let pieOptions     = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            // String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth   : 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps       : 100,
            // String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : false,
            // String - A legend template
            legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
            // String - A tooltip template
            tooltipTemplate      : '<%=value %> <%=label%>'
        };
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        // -----------------
        // - END PIE CHART -
        // -----------------
            }
 */
   


    // function mostrarGraficos(ventas){
    //     const ventas_array = $.parseJSON(ventas); //pasamos de JSON a array
  
    //     let fechas_ventas = [];
    //     ventas_array.forEach(venta => {
    //         let objeto_fecha_venta = {
                
    //             y:venta['fecha'],
    //             ventas: venta['total']

    //         }
    //         fechas_ventas.push(objeto_fecha_venta);    
    //     });
    //     const datos = fechas_ventas
    //     console.log(datos)
    //     let line = new Morris.Line({

    //         element          : 'line-chart',
    //         resize           : true,
    //         data             : datos,
    //         xkey             : 'y',
    //         ykeys            : ['ventas'],
    //         labels           : ['ventas'],
    //         lineColors       : ['#efefef'],
    //         lineWidth        : 2,
    //         hideHover        : 'auto',
    //         gridTextColor    : '#fff',
    //         gridStrokeWidth  : 0.4,
    //         pointSize        : 4,
    //         pointStrokeColors: ['#efefef'],
    //         gridLineColor    : '#efefef',
    //         gridTextFamily   : 'Open Sans',
    //         gridTextSize     : 10
    //         });
       
    // }

 

}




