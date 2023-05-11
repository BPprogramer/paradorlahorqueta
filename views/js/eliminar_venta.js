


if($('.btn_eliminar_venta').length>0){
    
    //eventos
    $(document).on('click', '.btn_eliminar_venta',alertaEliminar);


   
    function consultarVenta(id){
        
        const datos = new FormData();
        datos.append('id', id),
        datos.append('delete', 'delete')
        
        $.ajax({
            url :"ajax/AjaxVentas.php",
            method:'POST',
            data :datos,
            cache: false,
            contentType:false,
            processData:false,
            dataType:'json',
            success:function(req){
                console.log(req)
                if(req=='success'){
                    Swal.fire({
                        title: `Se ha eliminado la venta exitosamente `,
                        icon: 'success',
                        showCancelButton:false,
                        confirmButtonColor:'#7066e0',
                        confirmButtonText: 'si, Eliminar',
                    }).then((result)=>{
                        if(result.isConfirmed){
                         
                            location.reload();
                        }
                    })
                }
                if(req=='pendiente'){
                        
                    Swal.fire({
                        title: 'No se puede eliminar por saldo pendiente',
                        icon:'warning',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: 'aceptar',
                        
                    })
                }
            },
            error:function(error){
                console.log(error.responseText)
               
            }
        })
    }

    function alertaEliminar(){ //preguntar si esta seguro de que desea eliminar la venta
        const id = $(this).attr('id_venta_eliminar');
        const codigo = $(this).parent().parent().parent().children('.codigo').text()
        Swal.fire({
            title: `¿Está Seguro de Eliminar La venta numero ${codigo}?`,
            text: 'Esta acción no se podrá deshacer',
            icon: 'warning',
            width:'32rem',
            showCancelButton:true,
            confirmButtonColor:'#7066e0',
            cancelButtonColor:'#6e7881', 
            confirmButtonText: 'si, Eliminar',
            cancelButtonText: 'Cancelar'

        }).then((result)=>{
            if(result.isConfirmed){
             
                consultarVenta(id)
            }
        })
}

}

