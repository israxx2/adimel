<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table" id="tablaCarrito">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">Eliminar</th>
                                    <th class="li-product-thumbnail">Imagen</th>
                                    <th class="cart-product-name">Producto</th>
                                    <th class="li-product-price">Precio Unitario</th>
                                    <th class="li-product-quantity">Cantidad</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Total</h2>
                                <ul>
                                    <li>Subtotal <span id="subtotal3">$0</span></li>
                                    <li>Total <span id="total4">$0</span></li>
                                </ul>
                                <a href="/checkout">COMPRAR</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    let carrito = [];
    if(localStorage.getItem("carrito")!=null){
        carrito=localStorage.getItem("carrito");
        carrito=JSON.parse(carrito);
    }

    carrito.forEach(producto => {
		$('#tablaCarrito > tbody').append(`
            <tr id="tr-`+producto.index+`" >
                <td class="li-product-remove"><a onclick="Eliminar('`+producto.index+`')"><i class="fa fa-times"></i></a></td>
                <td class="li-product-thumbnail"><a href="#"><img width="90px" heigth="90px" src="/imageProducts/`+producto.id+`.png" alt="ProductoImagen"></a></td>
                <td class="li-product-name"><a href="#">`+producto.nombre+`</a></td>
                <td class="li-product-price"><span class="amount">`+producto.precio+`</span></td>
                <td class="quantity">
                    <div class="cart-plus-minus" onclick="changeCantidad(this,`+producto.index+`)">
                        <input disabled class="cart-plus-minus-box"  value="`+producto.cantidad+`" type="text">
                        <div class="dec qtybutton" >
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inc qtybutton" >
                            <i class="fa fa-angle-up" ></i>
                        </div>
                    </div>
                </td>
                <td class="product-subtotal"><span class="amount" id="total5-`+producto.index+`">`+producto.total+`</span></td>
            </tr>

			`)
	
        });



</script>