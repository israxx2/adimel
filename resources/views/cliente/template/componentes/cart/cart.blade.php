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
                                @foreach (Auth::guard('cliente')->user()->carrito as $p)
                                <tr id="tr-{{$p->prod_codigo}}" >
                                    <td class="li-product-remove"><a onclick="Eliminar('{{$p->prod_codigo}}')"><i class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="/viewProduct/{{$p->prod_codigo}}"><img width="90px" heigth="90px" src="/uploads/productos/{{{$p->prod_codigo}}}.png" alt="ProductoImagen"></a></td>
                                    <td class="li-product-name"><a href="/viewProduct/{{$p->prod_codigo}}">{{$p->prod_nombre}}</a></td>
                                    <td class="li-product-price"><span class="amount">{{$p->producto->pro_valor_venta1}}</span></td>
                                    <td class="quantity">
                                        <div class="cart-plus-minus" onclick='changeCantidad(this,"{{$p->prod_codigo}}")'>
                                            <input disabled class="cart-plus-minus-box"  value="{{$p->cantidad}}" type="text">
                                            <div class="dec qtybutton" >
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                            <div class="inc qtybutton" >
                                                <i class="fa fa-angle-up" ></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span class="amount" id="total5-{{$p->prod_codigo}}">{{$p->cantidad*$p->producto->pro_valor_venta1}}</span></td>
                                </tr>
                                @endforeach
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
