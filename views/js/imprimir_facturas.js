
if($('.btn_imprimir_factura').length>0){

    $('.tablas').on('click', '.btn_imprimir_factura',function(){
        const codigo = $(this).attr('codigo_factura');
        window.open("extensiones/tcpdf/pdf/factura.php?id="+codigo, "_blank")
    })
    
}