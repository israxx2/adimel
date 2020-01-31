
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="">
                    <div class="checkbox-form">
                        <h3>Detalles del comprador</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <p><b>Nombre:</b> {{ Auth::guard('cliente')->user()->dep_cli_nombre }}</p>  
                                <p><b>Correo:</b> {{ Auth::guard('cliente')->user()->dep_cli_email }}</p>   
                                <p><b>Giro:</b> {{ Auth::guard('cliente')->user()->cli_giro }}</p>  
                               
                               
                                @if(is_null(Auth::guard('cliente')->user()->dep_cli_direccion))
                                <br>
                                 <h3>Ingrese Dirección</h3>
                                    @include('cliente.template.componentes.cart.newDireccion')
                                @else
                                  
                                    <div class="row">
                                        @foreach(Auth::guard('cliente')->user()->getDirecciones() as $d)
                                            
                                            <div class="col-md-1 col-sm-1">
                                                <input style="height:2px;" type="radio" id="direccion" name="direccion" value="{{$d->dep_cli_idn}}"/>     
                                            </div>
                                            <div class="col-md-11 col-sm-11" >
                                                <label for="direccion">   {{ $d->dep_cli_direccion}}</label>
                                            </div>

                                         @endforeach
                                    </div>
                                    <br>
                                    @include('cliente.template.componentes.cart.createDireccion') 
                                    
                                @endif
                            </div>
                        </div>
                     
                        <div class="order-notes">
                            <div class="checkout-form-list">
                                <label>Comentario</label>
                                <textarea id="checkout-mess" cols="30" rows="10" placeholder="Comentarios relacionados con el despacho de los productos"></textarea>
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
                                <input value="Efectuar Compra" type="submit" onclick="comprar(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          

<script>

function comprar(e){

    var user ={!! json_encode(Auth::guard('cliente')->user(), JSON_HEX_TAG) !!};
    let tipo, direccion,ciudad,comuna,telefono,comentario,id_direccion;

    if(!user.dep_cli_direccion){
        //caso de no tener direccion
        tipo="nueva"
        direccion= $('#direccion1').val();
        ciudad= $('#ciudad1').val();
        comuna= $('#comuna1').val();
        telefono= $('#telefono1').val();
    }
    else{
        let check = $('#ship-box')[0].checked;
        if(check){
            //caso de tener una direccion y crear otra
            tipo="crear"
            direccion= $('#direccion2').val();
            ciudad= $('#ciudad2').val();
            comuna= $('#comuna2').val();
            telefono= $('#telefono2').val();
        }
        else{
            //caso de tener una direccion y enviar a esa mism
            tipo="actual"
            id_direccion = $("input[name='direccion']:checked").val();
        }
     
    }

    comentario= $('#checkout-mess').val();
    data={
        tipo:tipo,
        direccion:direccion,
        ciudad:ciudad,
        comuna:comuna,
        telefono:telefono,
        comentario: comentario,
        id_direccion:id_direccion
    }

	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $.ajax({
            url: "/efectuarcompra",
            type: "POST",
            data: data,
            success: function () {
                console.log("enviada")
            }
        });

}

</script>