<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/1.jpg" data-gall="myGallery">
                                <img src="{{ asset('electro/images/product/large-size/2.jpg') }}" alt="product image">
                            </a>
                        </div>
                        <div class="lg-image">
                            <a class="popup-img venobox vbox-item" href="images/product/large-size/2.jpg" data-gall="myGallery">
                                <img src="{{ asset('electro/images/product/large-size/1.jpg') }}"alt="product image">
                            </a>
                        </div>
                        
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">                                        
                        <div class="sm-image"><img src="{{ asset('electro/images/product/small-size/2.jpg') }}" alt="product image thumb"></div>
                        <div class="sm-image"><img src="{{ asset('electro/images/product/small-size/1.jpg') }}" alt="product image thumb"></div>
                </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{$productos->first()->pro_nombre}}</h2>
                        <span class="product-details-ref">Reference: demo_15</span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="review-item"><a href="#">Read Review</a></li>
                                <li class="review-item"><a href="#">Write Review</a></li>
                            </ul>
                        </div>
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2">${{$productos->first()->pro_valor_venta1}}</span>
                        </div>
                        <div class="product-desc">
                            <p>
                                <span>{{$productos->first()->pro_nombre}}
                                </span>
                            </p>
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