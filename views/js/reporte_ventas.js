


//mostrar rangos de venta por fecharemove

$('.tables').ready(function(){
  let data_range_li;
    if($('#daterange_btn_reporte').length>0){
      
   
        verificarLocalStorage();
        dateRangerPicker();
        hoverRangoPersonalzado()
          //click en el boton cancelar
        $('.cancelBtn').click(cancelarRango)
         //click al hoy 
        $('.daterangepicker .ranges li').on('click', clickHoy);
    }


 
  

 

  //click en fecha
  $('#daterange_btn_reporte').click(claseActive)
  
   

    function dateRangerPicker(){
     
        $('#daterange_btn_reporte').daterangepicker(
            {
              ranges   : {
                'Hoy'       : [moment(), moment()],
                'Ayer'   : [moment().subtract(1, 'days'), moment()],
                'Últimos 3 días': [moment().subtract(2, 'days'), moment()],
                'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
                'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                'Este més'  : [moment().startOf('month'), moment().endOf('month')],
                'Úlltimo més'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Desde el principio': [moment('2023-01-01'), moment()]
              },
              startDate: moment(),
              endDate  : moment()
            },
            
            function (start, end) {
              $('#daterange_btn_reporte span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
              const fecha_inicial = start.format('YYYY-MM-DD'); //fecha inicial
              const fecha_final = end.format('YYYY-MM-DD'); //fecha final
              
              const rango = $('#daterange_btn_reporte span').html();
              getRango(rango, fecha_final, fecha_inicial);
          

              
            }
          )
        
    }

    function verificarLocalStorage(){
          if(localStorage.getItem('rango_reportes')!=null){
              $('#daterange_btn_reporte span').html(localStorage.getItem('data_range_li'));
             
          }else{
            const fechaHoy = moment().format('MMMM D, YYYY');
            const fechaHace3Dias = moment().subtract(3, 'days').format('MMMM D, YYYY');
            const rango =  fechaHace3Dias + ' - ' + fechaHoy;
             $('#daterange_btn_reporte span').html('<i class="fa fa-calendar"></i> Ultimos tres dias');
           
        }
    }


    function cancelarRango(){
        //localStorage.removeItem('capturarRango');
        localStorage.clear();
        window.location="reporte-ventas"

    }

    //obtenemos a que rango le dimos click para luego ponerlo como active
    function clickHoy(e){
      data_range_li = $(this).attr('data-range-key');
    
      if(data_range_li=='Hoy'){
        const fecha = new Date();
       
        let dia = fecha.getDate();
        let mes = fecha.getMonth()+1;
        let year = fecha.getFullYear();
      
        if(mes<10){
          mes = "0"+mes;
        }
        if(dia<10){
          dia = "0"+dia;
        }

        const fecha_inicial = year+'-'+mes+'-'+dia;
       
        const fecha_final = fecha_inicial;
        
        const opciones = { year: 'numeric', month: 'short', day: 'numeric' };
        const fecha_formateada = fecha.toLocaleDateString('en-US', opciones);
        const rango = fecha_formateada+'-'+fecha_formateada;
      
        getRango('Hoy', fecha_final, fecha_inicial);
     
      
      }
    }

    //eliminar la seleccion por defecto borrando la clase active y agragar la clase active al rango selecconado
    function claseActive(){
        
        if($('.active').length>0){
          $('.active').removeClass('active');
        }else{
          console.log('hola')
          $('[data-range-key="Últimos 3 días"]').addClass('active');  
        }
       if(localStorage.getItem('data_range_li')!=null){
       
          const valor = localStorage.getItem('data_range_li');
          $(`[data-range-key="${valor}"]`).addClass('active');
        }
    }

    //hacemos get a a las fechas y guardamos en en storgae el rango y el li del rango seleccionado
    function getRango(rango, fecha_final, fecha_inicial){
      localStorage.setItem('rango_reportes', rango);
      localStorage.setItem('data_range_li', data_range_li);
      window.location="index.php?ruta=reporte-ventas&fi="+fecha_inicial+"&ff="+fecha_final;
    }
    function hoverRangoPersonalzado(){
      $('.daterangepicker .ranges li').ready(function(){
        
        $("[data-range-key='Rango Personalizado']").hover(function(){
         
            const valor = localStorage.getItem('data_range_li');
            if(valor!='Hoy'){
                $(`[data-range-key="${valor}"]`).addClass('active');
                setTimeout(()=>{
                
                  $(`[data-range-key="Hoy"]`).removeClass('active');
                },0)
            }             
        });
      })
    }
})
