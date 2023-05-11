
$(document).ready(function(){
    const colores_hexa = ['#f56954','#00a65a', '#f39c12','#00c0ef','#3c8dbc','#a9acb6','#1E90FF','#006400', '#FF0000', '#8A2BE2'];
    const colores_text = ['red','green', 'yellow','aqua','blue','muted', 'primary', 'success', 'danger','purple',];
    let array_objetos_producto = []
    if($('#pieChart').length>0 && $('.inicio').length>0){
       
        consultaProductos();
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
})

