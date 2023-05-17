

 $(".tablaProductos").dataTable().fnDestroy(); //por si me da error de reinicializar

$('.tablaProductos').DataTable({
    ajax: 'ajax/AjaxTablaProductos.php',
    "deferRender":true,
    "retrieve":true,
    "proccesing":true
});


$('#idCategoria').change(function(){
    const idCategoria = $(this).val();
 
    const datos = new FormData();
    datos.append('id_categoria', idCategoria);

    $.ajax({
        url:"ajax/AjaxProductos.php",
        method:"POST",
        data:datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(req){
            let nuevoCodigo;
            if(!req){
                 nuevoCodigo = idCategoria+"01";
            }else{
                const ultimoCodigo = Number(req['codigo']);
                
                 nuevoCodigo = ultimoCodigo+1;
            }
            
           
            $('#codigo').val(nuevoCodigo)
            $('#codigo').attr('readonly',true);

         
        },
        error:function(error){
           console.log(error.responseText)
        }
    
    })
})









$('.form_agregar_producto').submit(function(e){
   e.preventDefault();
   if($('.alerta').length>0){
    $('.alerta').remove();
}

    const idCategoria = $('#idCategoria').val();

    const codigo = $('#codigo').val();
    const descripcion = $('#descripcion').val();
    const stock = $('#stock').val();
    const precio_compra = $('#precio_compra').val();
    const precio_venta = $('#precio_venta').val();

    const imagen = $('#imagen').prop('files')[0];

    const datos = new FormData();
    const datos_producto = true;
    datos.append('idCategoria',idCategoria)
    datos.append('codigo',codigo)
    datos.append('descripcion',descripcion)
    datos.append('stock',stock)
    datos.append('precio_compra',precio_compra)
    datos.append('precio_venta',precio_venta)
    datos.append('imagen',imagen)
  
    datos.append('datos_producto',datos_producto)
 
    $.ajax({
        url:"ajax/AjaxProductos.php",
        method:"POST",
        data:datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(req){
            console.log(req)
            if(req==['imagen no compatible']){
                $('.form_group_imagen').after('<div class="alert alert-danger text-center alerta">Imagen no Compatible</div>');
                return;
            }
            if(req=='datos_invalidos'){
                if(!$('.alerta').length>0){
                    $('.form_group_imagen').after('<div class="alert alert-danger text-center alerta">todos los campos son obligatorios y deben ser validos</div>')
                }
                return;
            }else if(req=='error'){
                $('.alerta').remove()
                Swal.fire({
                    title: 'Hubo un error, por favor intenta nuevamente',
                    type:'error',
                    icon:'error',
                    showCancelButton: false,
                    confirmButtonColor:'#3085d6',
     
       
                    confirmButtonText: 'ACEPTAR'
            
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                })
            }else{
                $('.alerta').remove()
                Swal.fire({
                    title: 'Producto Almacenado Correctamente',
                    type:'success',
                    icon:'success',
                    showCancelButton: false,
                    confirmButtonColor:'#3085d6',
     
       
                    confirmButtonText: 'ACEPTAR'
            
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                })
            }

         
        },
        error:function(error){
           
        }
    
    })
  
})


/* subitr imagen del producto */
$(".imagen").change(function(){
    const imagen = this.files[0];

    
    //validar que laimagen sea jpg o png
    console.log(imagen['type'])
    if(imagen['type'] != "image/jpeg" && imagen['type']!= "image/png"){
        console.log('mirndo imagen')
        $('.imagen').val("");
        Swal.fire({
            icon:'error',
            title: "la imagen debe ser formato jpg o png",
            
            type: "error",
            confirmButtonText: "Cerrar"
        })
    }else if(imagen["size"]>2000000){
        $('.imagen').val("");
        Swal.fire({
            icon:"error",
            title:"El Máximo peso de la imagen son 2 MBytes",
            type:'error',
            confirmButtonText: "cerrar"
           
        })
    }else{

        //imprimimos la foto en el formulario
        const dataImg = new FileReader;
        dataImg.readAsDataURL(imagen);

        $(dataImg).on("load", e=>{
            const rutaImg = e.target.result;
         
            $('.ver_imagen').attr("src", rutaImg);
        })
    }

});


/* traerme los datos a editar*/
$(document).on('click', '.btnEditarProducto',function(){
   
    const id = $(this).attr('idProducto');
    const datos = new FormData();
    datos.append('id', id);
    $.ajax({
        url: 'ajax/AjaxProductos.php',
        method: 'POST',
        data: datos,
        cache: false,
        processData:false,
        contentType:false,
        processData:false,
        dataType:'json',
        success:function(req){
        
         
            $('#id_producto').val(req['id']);
            $('#editar_codigo').val(req['codigo'])
            $('#editar_codigo').attr('readonly', true)
            $('#editar_descripcion').val(req['descripcion'])
            $('#editar_stock').val(req['stock'])
            $('#editar_precio_compra').val(req['precio_compra'])
            $('#editar_precio_venta').val(req['precio_venta'])
            $('#imagen_actual').val(req['imagen'])
            $('.ver_imagen_editar').attr('src', req['imagen']);

           
            const id_categoria = req['id_categoria'];
            const datosCategoria = new FormData();
            datosCategoria.append('id_categoria_consulta', id_categoria);

            $.ajax({
                url: 'ajax/AjaxProductos.php',
                method: 'POST',
                data: datosCategoria,
                cache: false,
                processData:false,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(req){
            
                    if($('.option_codigo').length>0){
                        $('.option_codigo').remove()
                    }
                    $('#categoria_editar').append($('<option class="option_codigo"></option>').attr({'readonly': true, 'value':id_categoria}).text(req['nombre']))
                  
                  
                 
                }
            })
        }
      

    })
})





//envio del formulario

$('.form_editar_producto').submit(function(e){
    if($('.alerta').length>0){
        $('.alerta').remove()
     }

    e.preventDefault();
     const datosProducto = [ $('#editar_descripcion').val(),$('#editar_stock').val(),$('#editar_precio_compra').val(),$('#editar_precio_venta').val()]
     if(datosProducto.some(dato=>dato=='')){
         
         $('.form_group_imagen_editar').after('<div class="alert alert-danger text-center alerta">Todos los Campos Son Obligatorios excepto la imagen</div>')
         return;
     }
   
     const id_producto = $('#id_producto').val();
  
     const editar_descripcion = $('#editar_descripcion').val();
     const editar_stock = $('#editar_stock').val();
     const editar_precio_compra = $('#editar_precio_compra').val();
     const editar_precio_venta = $('#editar_precio_venta').val();
 
     const editar_imagen = $('#editar_imagen').prop('files')[0];
 
     const datos = new FormData();


     datos.append('id_producto',id_producto);
     datos.append('editar_descripcion',editar_descripcion)
     datos.append('editar_imagen', editar_imagen);
     datos.append('editar_stock',editar_stock)
     datos.append('editar_precio_compra',editar_precio_compra)
     datos.append('editar_precio_venta',editar_precio_venta)
     //datos.append('imagen',imagen)
   
     
  
     $.ajax({
         url:"ajax/AjaxProductos.php",
         method:"POST",
         data:datos,
         cache:false,
         contentType: false,
         processData: false,
         dataType: "json",
         success:function(req){
            console.log(req)
            if(req==['imagen no compatible']){
                $('.form_group_imagen_editar').after('<div class="alert alert-danger text-center alerta">Imagen no Compatible</div>');
                return;
            }
         
            if(req=='id_invalido'){
                window.location='productos'
            }
            if(req=='datos_no_validos'){
                if($('.alerta').length>0){
                    $('.alerta').remove()
                 }
                 $('.form_group_imagen_editar').after('<div class="alert alert-danger text-center alerta">No se Permiten caracteres especiales</div>')
                 return;
            }
            if(req=='success'){
                if( $('.alerta').length>0){
                    $('.alerta').remove()
                }
                Swal.fire({
                    title: 'Producto Editado Correctamente',
                    type:'success',
                    icon:'success',
                    showCancelButton: false,
                    confirmButtonColor:'#3085d6',
     
       
                    confirmButtonText: 'ACEPTAR'
            
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                })
            }
          
         
 
          
         },
         error:function(error){
            console.log(error.responseText)
         }
     
     })
   
 })

 /* editar imagen */

$("#editar_imagen").change(function(){

  
    const imagen = this.files[0];
    
    if($('.alerta').length>0){
        $('.alerta').remove();
    }
    
    //validar que laimagen sea jpg o png
    console.log(imagen['type'])
    console.log(imagen['size'])
    if(imagen['type'] != "image/jpeg" && imagen['type']!= "image/png"){
       console.log('mirando imagen')
        $('.form_group_imagen_editar').after('<div class="alert alert-danger text-center alerta">solo formato jpg y png</div>')
    }else if(imagen["size"]>2000000){
       
        $('.form_group_imagen_editar').after('<div class="alert alert-danger text-center alerta">el peso debe ser menor a 2Megas</div>')
    }else{

        //imprimimos la foto en el formulario
        const dataImg = new FileReader;
        dataImg.readAsDataURL(imagen);

        $(dataImg).on("load", e=>{
            const rutaImg = e.target.result;
         
            $('.ver_imagen_editar').attr("src", rutaImg);
        })
    }

});


/* Eliminar el producto */

$(document).on('click', '.btnEliminarProducto',function(){
    if($('.alerta').length>0){
        $('.alerta').remove();
    }
    const id_eliminar = $(this).attr('idProducto');

    Swal.fire({
        title:'Esta Seguro que Desea Eliminar este Producto?',
        text: 'esta accion no se puede deshacer',
        head: 'esta acción no tiene',
        icon: 'warning',
        type: 'warning',
        showCancelButton:true,
        cancelButtonText:'Cancelar',
        confirmButtonText: 'si, eliminar Producto'
    }).then((result)=>{
        if(result.value){
            
            const datos = new FormData();
            datos.append('id_eliminar', id_eliminar);
            $.ajax({
                url: 'ajax/AjaxProductos.php',
                method:'POST',
                data:datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(req){
                    console.log(req)
                    if(req=='error'){
                        Swal.fire({
                            icon:'error',
                            title: 'Opps, hubo un error',
                            text: 'porfavor intenta nuevamente',
                        })
                      
                    }else{
                        Swal.fire({
                            title: 'Producto Eliminado Correctamente',
                            type:'success',
                            icon:'success',
                            showCancelButton: false,
                            confirmButtonColor:'#3085d6',
             
               
                            confirmButtonText: 'ACEPTAR'
                    
                        }).then((result)=>{
                            if(result.value){
                                window.location = "productos";
                            }
                        })
                    }
                },
                error:function(error){
                    console.log(error)
                }

            })
        }
    })

})