<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Descripción</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Detalles del Producto</span></a></li>
                     
                    </ul>               
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span>{{$productos->first()->pro_nombre}}</span>
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <a href="#">
                        @if (file_exists('uploads/productos/'.$productos->first()->pro_idn.'.png'))
                            <img src="{{ asset('uploads/productos/'.$productos->first()->pro_idn.'.png') }}" width="240px" height="240px" alt="Product Image">
                        @else
                            <img src="{{ asset('uploads/productos/noimage.png') }}" width="240px" height="240px" alt="Product Image">
                        
                        @endif
                    </a>
                    <p><span>{{$productos->first()->pro_nombre}}</span> </p>
                  
                </div>
            </div>
  
        </div>
    </div>
</div>


