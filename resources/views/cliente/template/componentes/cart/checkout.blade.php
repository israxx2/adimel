
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="#">
                    <div class="checkbox-form">
                        <h3>Detalles del comprador</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Nombre:</b> {{ Auth::guard('cliente')->user()->dep_cli_nombre }}</p>   
                                <p><b>Ciudad:</b> {{ Auth::guard('cliente')->user()->dep_cli_ciudad }}</p>  
                                <p><b>Dirección:</b> {{ Auth::guard('cliente')->user()->dep_cli_direccion }}</p>  
                                <p><b>Correo:</b> {{ Auth::guard('cliente')->user()->dep_cli_email }}</p>  
                                <p><b>Fono:</b> {{ Auth::guard('cliente')->user()->dep_cli_fono }}</p>  
                                <p><b>Giro:</b> {{ Auth::guard('cliente')->user()->cli_giro }}</p>  
                            </div>
                        </div>
                        <hr>
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Enviar a una direccion diferente?</label>
                                    <input id="ship-box" type="checkbox">
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">
                                <div class="col-md-12">
                                    <div class="country-select clearfix">
                                        <label>Ciudad <span class="required">*</span></label>
                                        <select class="nice-select wide">
                                            <option data-display="Talca">Talca</option>
                                            <option value="Santiago">Santiago</option>
                                            <option value="Linares">Linares</option>
                                            <option value="San Javier">San Javier</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Nombre <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Apellidos <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Compañia</label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Direccion <span class="required">*</span></label>
                                        <input placeholder="Direccion" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input placeholder="departamento, piso, etc. (opcional)" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Ciudad <span class="required">*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Comuna <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Codigo Postal<span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Correo<span class="required">*</span></label>
                                        <input placeholder="" type="email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Telefono  <span class="required">*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Comentarios</label>
                                    <textarea id="checkout-mess" cols="30" rows="10" placeholder="Comentarios relacionados con el despacho de los productos"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12">
                <div class="your-order">
                    <h3>Tu orden</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table" id="tableCheckOut">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Producto</th>
                                    <th class="cart-product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::guard('cliente')->user()->carrito as $p)
                                <tr class="cart_item">
                                    <td class="cart-product-name">{{$p->prod_nombre}}<strong class="product-quantity"> × {{$p->cantidad}}</strong></td>
                                    @if($p->producto->isOffer()->des_pro_estado!=null)

                                        <td class="cart-product-total"><span class="amount">{{$p->cantidad*$p->producto->isOffer()->des_pro_precio}}</span></td>  
                                    @else						
                                        <td class="cart-product-total"><span class="amount">{{$p->cantidad*$p->producto->pro_valor_venta1}}</span></td>  
                                    @endif

                                    



                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>SUBTOTAL</th>
                                    <td><span id="subtotalCheckOut" class="amount">0</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>TOTAL</th>
                                    <td><strong><span id="totalCheckOut" class="amount">0</span></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                <div class="card">
                                <div class="card-header" id="#payment-1">
                                    <h5 class="panel-title">
                                    <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Transferencia Bancaria
                                    </a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Banco:</p>
                                        <p>Numero de Cuenta:</p>
                                        <p>Tipo de Cuenta:</p>
                                        <p>Monto:</p>
                                    </div>
                                </div>
                                </div>

                            </div>
                            <div class="order-button-payment">
                                <input value="Efectuar Compra" type="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          

