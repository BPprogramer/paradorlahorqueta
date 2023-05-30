
if($('.tablaProveedores').length>0){


$(".tablaProveedores").dataTable().fnDestroy(); //por si me da error de reinicializar

$('.tablaProveedores').DataTable({
    ajax: 'ajax/AjaxTablaProveedores.php',
    "deferRender":true,
    "retrieve":true,
    "proccesing":true
});

// if($('.tablaProveedores').length>0){
//     $(document).ready(function(){
//        $.ajax({
//             url:"ajax/AjaxTablaProveedores.php",
          
       
//             success:function(req){
//                 console.log(req)
//             },
//             error:function(error){
//                 console.log(error);
//             }
//         })
//     })
// }



//Crear un proveedor

$('.formulario_guardar_proveedor').submit(function(e){
    e.preventDefault();
    const nombre = $('#nombre').val();
    const telefono = $('#telefono').val();
    const direccion = $('#direccion').val();
    const arreglo = [nombre,telefono,direccion];

    if($('.alerta').length>0){
        $('.alerta').remove();
    }

    if(arreglo.some(dato=> dato=='')){
        $(this).append('<div class="alert alert-danger alerta text-center">Todos los Campos son Obligatorios</div>');
        return;
    }

    console.log(nombre)
    console.log(telefono)
    console.log(direccion)
    const datos = new FormData();
    datos.append('nombre', nombre);
    datos.append('telefono', telefono);
    datos.append('direccion', direccion);


    
    $.ajax({
        url:"ajax/AjaxProveedores.php",
        method:"POST",
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(req){
  
            console.log(req)
            if(req=='no-validate'){
            
                $('.formulario_guardar_proveedor').append('<div class="alert alert-danger alerta text-center">datos no validos</div>');
               return;
            }
            if(req=='error'){
            
                $('.formulario_guardar_proveedor').append('<div class="alert alert-danger alerta text-center">hubo un error por favor intenet nuevamente</div>');
               return;
            }
            if(req=='success'){
                if($('.alerta').length>0){
                    $('.alerta').remove();
                }
                Swal.fire({
                    title: 'Proveedor Almacenado Correctamente',
                    type:'success',
                    icon:'success',
                    showCancelButton: false,
                    confirmButtonColor:'#3085d6',
     
       
                    confirmButtonText: 'ACEPTAR'
            
                }).then((result)=>{
                    if(result.value){
                        window.location = "proveedores";
                    }
                })
            }
            
        },
        error:function(error){
            console.log(error.responseText)
        }
    })
  
})


//traeme los datos actulaes del proveedor
$(document).on('click', '.btnEditarProveedor',function(){
    const id_proveedor = $(this).attr('idProveedor');
    const datos = new FormData();
    datos.append('id_proveedor',id_proveedor);
    $.ajax({
        url: "ajax/AjaxProveedores.php",
        method: "POST",
        data: datos,
        cache:false,
        processData:false,
        contentType:false,
        dataType:"json",
        success:function(req){
            
            $('#editar_nombre').val(req['nombre'])
            $('#editar_telefono').val(req['telefono'])
            $('#editar_direccion').val(req['direccion'])
            $('#id_editar_proveedor').val(req['id']);
        },
        error:function(error){
            console.log(error.responseText)
        }

    })

})

//editar Proveedor
$('.formulario_editar_proveedor').submit(function(e){
    e.preventDefault();

    if($('.alert').length>0){
        $('.alert').remove();
    }
    const id_editar_proveedor = $('#id_editar_proveedor').val();
    const editar_nombre = $('#editar_nombre').val();
    const editar_telefono = $('#editar_telefono').val();
    const editar_direccion = $('#editar_direccion').val();

    const datos = new FormData();
    datos.append('id_editar_proveedor',id_editar_proveedor);
    datos.append('editar_nombre',editar_nombre)

    datos.append('editar_telefono',editar_telefono)
    datos.append('editar_direccion',editar_direccion)


    
    $.ajax({
        url: 'ajax/AjaxProveedores.php',
        method:'POST',
        data:datos,
        cache:false,
        contentType:false,
        processData:false,
        dataType:'json',
        success:function(req){
            console.log(req)
            
            if(req=='no_validate'){
               
                $('.formulario_editar_cliente').after('<div class="alert alert-danger text-center alerta">todos los campos son obligatorios y deben ser validos</div>')
               
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
                        window.location = "proveedores";
                    }
                })
            }else{
                $('.alerta').remove()
                Swal.fire({
                    title: 'Datos Actualizados Correctamente',
                    type:'success',
                    icon:'success',
                    showCancelButton: false,
                    confirmButtonColor:'#3085d6',
     
       
                    confirmButtonText: 'ACEPTAR'
            
                }).then((result)=>{
                    if(result.value){
                        window.location = "proveedores";
                    }
                })
            }
        },
        error:function(error){
            console.log(error.responseText)
        }

    })
})

$(document).on('click', '.btnEliminarProveedor', function(){
    



   
    Swal.fire({
        title:'Esta Seguro que Desea Eliminar este Proveedor?',
        text: 'esta accion no se puede deshacer',
        head: 'esta acción no tiene',
        icon: 'warning',
        type: 'warning',
        showCancelButton:true,
        cancelButtonText:'Cancelar',
        confirmButtonText: 'si, eliminar Proveedor'
    }).then((result)=>{
        if(result.value){
          
            const id_eliminar_proveedor = $(this).attr('idProveedor');
          
            const datos = new FormData();
            datos.append('id_eliminar_proveedor', id_eliminar_proveedor);
            $.ajax({
                url: 'ajax/AjaxProveedores.php',
                method:'POST',
                data:datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(req){
                    console.log(req)
                    if(req == 'fk_unrestricted'){
                     
                        Swal.fire({
                            icon:'error',
                            title: 'Opps, hubo un error',
                            html: 'Por Integridad de su información no puede eliminar este proveedor porque hay uno o mas productos al que se le ha asignado este proveedor.'+
                            '<br>Una opcion seria editar el proveedor en el (los) producto (s) y la otra sería eliminar el (los) producto (productos).'+
                            '<br>Cuando complete una de estas dos acciones podra eliminar el proveedor'
                        })
                    }
             
                    if(req=='error'){
                        Swal.fire({
                            icon:'error',
                            title: 'Opps, hubo un error',
                            text: 'porfavor intenta nuevamente',
                        })
                      
                    }
                    if(req=='no_permitido'){
                        Swal.fire({
                            icon:'error',
                            title: 'El Proveedor no se puede Eliminar Saldo Pendiente',
                            text: 'Saldo Pendiente',
                        })
                      
                    }
                    if(req=='success'){
                        Swal.fire({
                            title: 'Proveedor Eliminado Correctamente',
                            type:'success',
                            icon:'success',
                            showCancelButton: false,
                            confirmButtonColor:'#3085d6',
             
               
                            confirmButtonText: 'ACEPTAR'
                    
                        }).then((result)=>{
                            if(result.value){
                                window.location = "proveedores";
                            }
                        })
                    }
                },
                error:function(error){
                    console.log(error.responseText)
                }

            })
        }
    })

})


}