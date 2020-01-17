<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Productos Similares</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel"  >
                        @foreach ($similaryProducts as $s)
                         <div class="col-lg-12">
                                
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    @if (file_exists('uploads/productos/'.$s->pro_idn.'.png'))
                                        <img src="{{ asset('uploads/productos/'.$s->pro_idn.'.png') }}" alt="Product Image">
                                    @else
                                        <img src="{{ asset('uploads/productos/noimage.png') }}" alt="Product Image">
                                    
                                    @endif
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <h4><a class="product_name" href="/viewProduct/{{$s->pro_idn}}">{{$s->pro_nombre}}</a></h4>
                                        @if(Auth::guard('cliente')->check())
                                            <div class="price-box">									
                                                <span class="new-price">${{$s->pro_valor_venta1}}</span>
                                            </div>
                                        @else
                                            <center><small><i>Para ver los precios debe iniciar sesion</i></small></center>
                                        @endif
                                    </div>
                                
                                    <div class="add-actions">
                                        @if(Auth::guard('cliente')->check())
                                            <button  class="btn btn-sm btn-block" style="background-color: #0088C6; color:white" onclick="Añadir('{{$s->pro_idn}}','{{$s->pro_nombre}}','{{ $s->pro_valor_venta1}}','{{1}} ')"><span>AÑADIR</span></button>										
                                        @else
                                            <button class="btn btn-sm btn-block" style="background-color:#0088c6; color:white" data-toggle="modal" data-target="#modal_login"><span>Iniciar Sesión</span></button>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                          
                        </div>
     
                        @endforeach
                
                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
