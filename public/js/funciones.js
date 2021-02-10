
inicial();

function inicial(){

    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/getCarrito",
        type: "GET",
        success: function (carrito) {
            ActualizarVista(carrito);

        }
    });

    asdf();

    function asdf() {
        let aaa = new Date();
        let dd = aaa.getDate();
        let mm = aaa.getMonth()+1; 
        let yyyy = aaa.getFullYear();
        let html = '<div class="modal fade" id="modal_retraso" ><div class="modal-dialog modal-dialog-centered" style="width: 80% !important;"><div class="modal-content"><div class="modal-body"><div class="modal-inner-area row"><div class="col-sm-12"><div class="container"><center><h4 class="login-title">Versión de Prueba Caducada</h4></center><div class="row d-flex justify-content-center"><div class="col-md-12 col-12 mt-20 form-group mt-20"><p>Usted no ha realizado el pago total del sistema. Para eliminar este mensaje comunicarse con el desarrollador del sistema.</p></div></div></div></div></div></div></div></div></div><button type="button" data-toggle="modal" data-target="#modal_retraso" id="btn_retraso" style="display: none;"></button>';
        $('.body-wrapper').append(html);

        if(yyyy > 2021) {
            $("#btn_retraso").trigger("click");
        }
        else {
            if(mm >= 3) {
                $("#btn_retraso").trigger("click");   
            }
        }
    }
    

}

function ActualizarVista(carrito){
    let subtotal=0;
    $(".minicart-product-list").empty();

    carrito.forEach(producto => {
        subtotal= producto.precio*producto.cantidad + subtotal;

        $("#total5-"+producto.prod_codigo).text('$'+producto.precio*producto.cantidad); //total por producto
        $("#cantidad-"+producto.prod_codigo).text('$'+ producto.precio +'x' +producto.cantidad); //cantidad para carrito cabecera


        //añadir elproducto a la parte superior del carrito
        $(".minicart-product-list").append(`
            <li id="`+producto.prod_codigo+`">
            <a href="/viewProduct/`+producto.prod_codigo+`" class="minicart-product-image">

            <img src="/uploads/productos/`+producto.prod_codigo+`.png" alt="Producto">  
            </a>
            <div class="minicart-product-details">
            <h6><a href="/viewProduct/`+producto.prod_codigo+`">`+producto.prod_nombre+`</a></h6>
            <span id="cantidad-`+producto.prod_codigo+`">$`+producto.precio+` x `+producto.cantidad+`</span>
            </div>
            <button class="close" onclick="removeProducto('`+producto.prod_codigo+`')">
            <i class="fa fa-close"></i>
            </button>
            </li>
            `)




    });
    //totales para carrito de cabecera
    $("#subtotal1").text('$'+subtotal);
    $("#subtotal2").text('$'+subtotal);
    $("#cantidad").text(carrito.length);
    //totales para vista cart.
    $("#subtotal3").text('$'+subtotal);
    $("#total4").text('$'+subtotal);

    //totales para checkout
    $("#subtotalCheckOut").text('$'+subtotal);
    $("#totalCheckOut").text('$'+subtotal);

    
}


function changeCantidad(e,id_prod){

    let newCantidad=e.firstElementChild.value;
    $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
    $.ajax({
        url: "/editCarrito",
        type: "POST",
        data: {producto:id_prod,cantidad:newCantidad},
        success: function (response) {

            ActualizarVista(response)
        }
    });


}

function addProducto(id_prod,cantidad){

	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
  });

    $.ajax({
        url: "/addCarrito",
        type: "POST",
        data: {producto:id_prod,cantidad:cantidad},
        success: function (response) {
            ActualizarVista(response)
            toastr.success('Producto agregado', 
            {
                timeOut: 5000,
                progressBar: true,
                "positionClass": "toast-bottom-right",
            });
        }
    });


}

function removeProducto(id_prod){
	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
  });

    $.ajax({
        url: "/deleteCarrito",
        type: "POST",
        data: {producto:id_prod},
        success: function (response) {
            ActualizarVista(response) ;
            $('#tr-'+id_prod).empty();
            toastr.success('Producto eliminado', 
            {
                timeOut: 5000,
                progressBar: true,
                "positionClass": "toast-bottom-right",
            });
        }
    });


}


function imageExists(image_url){

    var http = new XMLHttpRequest();

    http.open('HEAD', image_url, false);
    http.send();

    return http.status != 404;

}