
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

										@if (file_exists('imageProducts/'.$p->pro_idn.'.png'))
											<img src="{{ asset('imageProducts/'.$p->pro_idn.'.png') }}" alt="Product Image">
										@else
											<img src="{{ asset('imageProducts/noimage.png') }}" alt="Product Image">
										
										@endif
									</a>
								</div>
							
								<div class="product_desc">
									<div class="product_desc_info">
										<h4><a class="product_name" href="viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
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

