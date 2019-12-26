<div class="shop-top-bar mt-30">
	<div class="shop-bar-inner">
		<div class="product-view-mode">
			<!-- shop-item-filter-list start -->
			<ul class="nav shop-item-filter-list" role="tablist">
				<li class="active" role="presentation">
					<a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view">
						<i class="fa fa-th"></i>
					</a>
				</li>
				<li role="presentation">
					<a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view">
					<i class="fa fa-th-list"></i>
				</a>
			</li>
			</ul>
			<!-- shop-item-filter-list end -->
		</div>

	</div>
	<!-- product-select-box start -->
	<div class="product-select-box">
		<div class="product-short">
			<p>Ordenar:</p>
			<select class="nice-select" style="display:none;">
				<option value="trending">Relevancia</option>
				<option value="sales">Nombre (A - Z)</option>
				<option value="sales">Nombre (Z - A)</option>
				<option value="rating">Precio (Low &gt; High)</option>
				<option value="date">Rating (Lowest)</option>
				<option value="price-asc">Modelo (A - Z)</option>
				<option value="price-asc">Modelo (Z - A)</option>
			</select>
			<div class="nice-select" tabindex="0">
				<span class="current">Relevancia</span>
				<ul class="list">
					<li data-value="trending" class="option selected">Relevance</li>
					<li data-value="sales" class="option">Name (A - Z)</li>
					<li data-value="sales" class="option">Name (Z - A)</li>
					<li data-value="rating" class="option">Price (Low &gt; High)</li>
					<li data-value="date" class="option">Rating (Lowest)</li>
					<li data-value="price-asc" class="option">Model (A - Z)</li>
					<li data-value="price-asc" class="option">Model (Z - A)</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- product-select-box end -->
</div>
<div class="shop-products-wrapper">
	<div class="tab-content">
		<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
			<div class="product-area shop-product-area">
				<div class="row">
					@foreach($productos as $p)
			
						<div class="col-lg-3 col-md-4 col-sm-6 mt-40">
							<!-- single-product-wrap start -->
							<div class="single-product-wrap">
								<div class="product-image">
									<a href="viewProduct/{{$p->pro_idn}}">
										<img src="{{ asset('electro/images/product/large-size/1.jpg') }}" alt="Li's Product Image">
									</a>
									<span class="sticker">New</span>
								</div>
								<div class="product_desc">
									<div class="product_desc_info">
										<div class="product-review">
											<h5 class="manufacturer">
												<a href="viewProduct/{{$p->pro_idn}}">Graphic Corner</a>
											</h5>
											<div class="rating-box">
												<ul class="rating">
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li class="no-star"><i class="fa fa-star-o"></i></li>
													<li class="no-star"><i class="fa fa-star-o"></i></li>
												</ul>
											</div>
										</div>
										<h4><a class="product_name" href="viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
										<div class="price-box">
											<span class="new-price">${{$p->pro_valor_venta1}}</span>
										</div>
									</div>
									<div class="add-actions">
										<ul class="add-actions-link">
											<li class="add-cart active"><a onclick="Añadir(' {{$p->pro_idn}}','{{$p->pro_nombre}}','{{ $p->pro_valor_venta1}}','{{1}}' )">Añadir</a></li>
											<li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- single-product-wrap end -->
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
			<div class="row">
				<div class="col">
					@foreach($productos as $p)
						<div class="row product-layout-list">
							<div class="col-lg-3 col-md-5 ">
								<div class="product-image">
									<a href="viewProduct/{{$p->pro_idn}}">
										<img src="{{ asset('electro/images/product/large-size/12.jpg') }}" alt="Li's Product Image">
									</a>
									<span class="sticker">New</span>
								</div>
							</div>
							<div class="col-lg-5 col-md-7">
								<div class="product_desc">
									<div class="product_desc_info">
										<div class="product-review">
											<h5 class="manufacturer">
												<a href="product-details.html">Graphic Corner</a>
											</h5>
											<div class="rating-box">
												<ul class="rating">
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li class="no-star"><i class="fa fa-star-o"></i></li>
													<li class="no-star"><i class="fa fa-star-o"></i></li>
												</ul>
											</div>
										</div>
										<h4><a class="product_name" href="viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
										<div class="price-box">
											<span class="new-price">${{$p->pro_valor_venta1}}</span>
										</div>
										<p>{{$p->pro_nombre}}</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="shop-add-action mb-xs-30">
									<ul class="add-actions-link">
										<li class="add-cart"><a href="#">Add to cart</a></li>
										<li class="wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a></li>
										<li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
									</ul>
								</div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function Añadir(id,nombre,precio,cantidad){
  
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