<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        <div class="lg-image">
                        
                                @if (file_exists('uploads/productos/'.$productos->pro_codigo.'.png'))
                                    <img src="{{ asset('uploads/productos/'.$productos->pro_codigo.'.png') }}" alt="Product Image">
                                @else
                                    <img src="{{ asset('uploads/productos/noimage.png') }}" alt="Product Image">
                                
                                @endif
                         
                        </div>
                    
                        
                    </div>
       
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{$productos->pro_nombre}}</h2>
                     
                        <div class="product-desc">
                            <p>
                                <span>{{$productos->pro_nombre}} </span>
                            </p>
                        </div>
                        @if(Auth::guard('cliente')->check())
                        <div class="price-box pt-20">
                         
                            @if($productos->isOffer()->des_pro_estado!=null)
                                								
                                <span class="new-price" value="{{$productos->pro_valor_venta1}}" style="color:red;">Antes: <strike>${{$productos->pro_valor_venta1}}</strike> </span>
                                <br><br>
                                <span class="new-price" style="color:green;"><strong>Ahora: ${{$productos->isOffer()->des_pro_precio}}</strong></span>
                            
                            @else						
                                 <span class="new-price new-price-2">${{$productos->pro_valor_venta1}}</span>
                            @endif
                            
                        </div>
                      
                        <div class="single-add-to-cart">
                            <form action="#" class="cart-quantity">
                                <div class="quantity">
                                    <label>Cantidad</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" disabled value="1" max="{{$productos->pro_stock}}" type="text">
                                        <div class="dec qtybutton"  ><i  class="fa fa-angle-down" ></i></div>
                                        <div class="inc qtybutton" ><i  class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button 
                                class="add-to-cart"  
                                style=color:#fff; 
                                onclick="funcion(this,'{{$productos->pro_codigo}}')"
                                >AÑADIR</button>
                                <br>
                                <small>Stock desfasado en 30 minutos. Al momento de efectuar la compra se revisará nuevamente</small>
                            </form>
                        </div>
                        @else
                        <small><i>Para ver los precios debe iniciar sesion </i></small>
                        <br><br>
                         <button class="btn btn-sm" style="background-color:#0088c6; color:white" data-toggle="modal" data-target="#modal_login"><span>Iniciar Sesión</span></button>		
                        @endif
                      
                        <div class="block-reassurance">
                          
                            <ul>
                                <br>
                                <li></li>
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

<script>

function funcion(e,id){
  
    cantidad=e.form[0].value;

    addProducto(id,cantidad);
}
</script>