
//editar categoria


$(document).on('click', '.btnEditarCategoria', function(){
 
    const idCategoria = $(this).attr("idCategoria");
   
    const datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/AjaxCategorias.php",
        method: 'POST',
        data: datos,
        cache:false,
        contentType:false,
        processData: false,
        dataType: "json",
        success: function(req){
           
            $('#editarCategoria').val(req[1]);
            $('#idEditarCategoria').val(req[0])
        },
        
        error:function(req, error){
            console.log(JSON.stringify(req))
        }
   
    })
})

/* Eliminar categoria */

$(document).on('click', '.btnEliminarCategoria', function(){
    const idCategoria = $(this).attr('idCategoria');
    console.log(idCategoria)
    Swal.fire({
        title: 'Estas Seguro que deseas Eliminar esta Categoria?',
        type:'warning',
        icon:'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelarButtonColor:'#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'si, Eliminar Categoría'

    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=categorias&id="+idCategoria;
        }
    })
})