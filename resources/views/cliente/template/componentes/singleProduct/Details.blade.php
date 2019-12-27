<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        <div class="lg-image">
                        
                                @if (file_exists('imageProducts/'.$productos->first()->pro_idn.'.png'))
                                    <img src="{{ asset('imageProducts/'.$productos->first()->pro_idn.'.png') }}" alt="Product Image">
                                @else
                                    <img src="{{ asset('imageProducts/noimage.png') }}" alt="Product Image">
                                
                                @endif
                         
                        </div>
                    
                        
                    </div>
       
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{$productos->first()->pro_nombre}}</h2>
                     
                        <div class="product-desc">
                            <p>
                                <span>{{$productos->first()->pro_nombre}} </span>
                            </p>
                        </div>
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2">${{$productos->first()->pro_valor_venta1}}</span>
                        </div>
                        
                        <div class="single-add-to-cart">
                            <form action="#" class="cart-quantity">
                                <div class="quantity">
                                    <label>Cantidad</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button 
                                class="add-to-cart"  
                                style=color:#fff; 
                                onclick="Añadir(' {{$productos->first()->pro_idn}}','{{$productos->first()->pro_nombre}}','{{ $productos->first()->pro_valor_venta1}}','{{1}}' )" 
                                >Añadir</button>
                            </form>
                        </div>

                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Politica de seguridad </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Politica de despacho</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p> Politica de devoluciones</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function Añadir(id,nombre,precio,cantidad){
    console.log(id,nombre,precio,cantidad)
    let carrito = [];

    if(localStorage.getItem("carrito")!=null){
        carrito=localStorage.getItem("carrito");
        carrito=JSON.parse(carrito);
    }
    
    let total= precio*cantidad;

   let product={
       id: id,
       nombre: nombre,
       precio: precio,
       cantidad: cantidad,
       total: total,
   }
    carrito.push(product)
    localStorage.setItem("carrito", JSON.stringify(carrito));
  
}

</script>