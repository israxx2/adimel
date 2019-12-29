

            <div class="content-wraper pt-60 pb-60 pt-sm-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-1 order-lg-2">
                            <!-- Begin Li's Banner Area -->
                            <div class="single-banner shop-page-banner">
                                <a href="#">
                                    <img src="/imageProducts/2.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                            <!-- Li's Banner Area End Here -->
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar mt-30">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        <span>Showing 1 to 9 of 15</span>
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sort By:</p>
                                        <select class="nice-select">
                                            <option value="trending">Relevance</option>
                                            <option value="sales">Name (A - Z)</option>
                                            <option value="sales">Name (Z - A)</option>
                                            <option value="rating">Price (Low &gt; High)</option>
                                            <option value="date">Rating (Lowest)</option>
                                            <option value="price-asc">Model (A - Z)</option>
                                            <option value="price-asc">Model (Z - A)</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            <div class="shop-products-wrapper">
                                <div class="tab-content">
                                    <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                        <div class="product-area shop-product-area">
                                            <div class="row">
                                                @foreach ($productos as $p)
                                                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                                        <!-- single-product-wrap start -->
                                                        <div class="single-product-wrap">
                                                            <div class="product-image">
                                                                <a ref="/viewProduct/{{$p->pro_idn}}">
                                                                    @if (file_exists('imageProducts/'.$p->pro_idn.'.png'))
                                                                        <img src="{{ asset('imageProducts/'.$p->pro_idn.'.png') }}" alt="Product Image">
                                                                    @else
                                                                        <img src="{{ asset('imageProducts/noimage.png') }}" alt="Product Image">
                                                                    
                                                                @endif  
                                                                </a>
                                                            
                                                            </div>
                                                            
                                                            <div class="product_desc">
                                                                <div class="product_desc_info">
                                                                    <h4><a class="product_name" href="/viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
                                                                    <div class="price-box">									
                                                                        <span class="new-price">${{$p->pro_valor_venta1}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="add-actions">
                                                                
                                                                    <button  class="btn btn-xs btn-block" style="background-color: #0088C6; color:white" onclick="Añadir('{{$p->pro_idn}}','{{$p->pro_nombre}}','{{ $p->pro_valor_venta1}}','{{1}} ')"><strong>AÑADIR</strong></button>
                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- single-product-wrap end -->
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                                @foreach ($productos as $p)
                                                <div class="row product-layout-list">
                                                    <div class="col-lg-3 col-md-5 ">
                                                        <div class="product-image">
                                                            <a href="viewProduct/{{$p->pro_idn}}">

                                                                @if (file_exists('imageProducts/'.$p->pro_idn.'.png'))
                                                                    <img src="{{ asset('imageProducts/'.$p->pro_idn.'.png') }}" alt="Product Image">
                                                                @else
                                                                    <img src="{{ asset('imageProducts/noimage.png') }}" alt="Product Image">
                                                                
                                                                @endif
                                                            </a>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-7">
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <h4><a class="product_name" href="viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
                                                                <div class="price-box">
                                                                    <span class="new-price">${{$p->pro_valor_venta1}}</span>
                                                                </div>
                                                                <p>{{$p->pro_nombre}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                     
                                                            <ul class="add-actions-link">
                                                                <button  class="btn btn-xs btn-block" style="background-color: #0088C6; color:white" onclick="Añadir('{{$p->pro_idn}}','{{$p->pro_nombre}}','{{ $p->pro_valor_venta1}}','{{1}} ')"><strong>AÑADIR</strong></button>
                                                             </ul>
                                                      
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paginatoin-area">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <p>Mostrando {{($productos->currentPage()-1)*$productos->count() +1}}-{{$productos->count()*$productos->currentPage()}} de {{$productos->total() }} productos</p>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <ul class="pagination-box">
                                                    <li><a href={{$productos->previousPageUrl()}}  class="Previous"><i class="fa fa-chevron-left"></i> Anterior</a>
                                                    </li>
                                                    <li class="active"><a href={{$productos->url($productos->currentPage())}}>{{$productos->currentPage()}}</a></li>
                                                    <li><a href={{$productos->url($productos->currentPage()+1)}}>{{$productos->currentPage()+1}}</a></li>
                                                    <li><a href={{$productos->url($productos->currentPage()+2)}}>{{$productos->currentPage()+2}}</a></li>
                                                    <li>
                                                        <a href={{$productos->nextPageUrl()}} class="Next"> Siguiente <i class="fa fa-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-products-wrapper end -->
                        </div>
                        <div class="col-lg-3 order-2 order-lg-1">
                            <!--sidebar-categores-box start  -->
                            <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                                <div class="sidebar-title">
                                    <h2>{{$cat->rub_nombre}}</h2>
                                </div>
                                <!-- category-sub-menu start -->
                                <div class="category-sub-menu">
                                    <ul>
                                        <li class="has-sub"><a href="# ">Prime Video</a>
                                            <ul>
                                                <li><a href="#">All Videos</a></li>
                                                <li><a href="#">Blouses</a></li>
                                                <li><a href="#">Evening Dresses</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-sub"><a href="#">Computer</a>
                                            <ul>
                                                <li><a href="#">TV & Video</a></li>
                                                <li><a href="#">Audio & Theater</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-sub"><a href="#">Electronics</a>
                                            <ul>
                                                <li><a href="#">Amazon Home</a></li>
                                                <li><a href="#">Kitchen & Dining</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- category-sub-menu end -->
                            </div>
                            <!--sidebar-categores-box end  -->

                        </div>
                    </div>
                </div>
            </div>
           