<div class="slider-with-banner">
	<div class="container">
		<div class="row">
			<!-- Begin Category Menu Area -->
			<div class="col-lg-3">
				<!--Category Menu Start-->
				<div class="category-menu category-menu-2">
					<div class="category-heading">
						<h2 class="categories-toggle"><span>CATEGORIAS</span></h2>
					</div>
					<div id="cate-toggle" class="category-menu-list">
						<ul>
							@foreach($categorias as $c)
								<li><a href="/categoria/{{$c->rub_idn}}">{{strtoupper($c->rub_nombre)}}</a></li>
							@endforeach
							
						</ul>
					</div>
				</div>
				<!--Category Menu End-->
			</div>
			<!-- Category Menu Area End Here -->
			<!-- Begin Slider Area -->
			<div class="col-lg-6 col-md-8">
				<div class="slider-area slider-area-3 pt-sm-30 pt-xs-30 pb-xs-30">
					<div class="slider-active owl-carousel">
						<!-- Begin Single Slide Area -->
						<div class="single-slide align-center-left animation-style-01 bg-7" style="background-image: url(uploads/productos/{{$offer1->pro_idn}}.png);">
							<div class="slider-progress"></div>
							<div class="slider-content">
								<h5>OFERTA! <span>- 20%</span></h5>
								<h2>{{$offer1->pro_nombre}} </h2>
								<h3>Precio oferta <span> ${{$offer1->pro_valor_venta1}} </span></h3>
								<div class="default-btn slide-btn">
									<a class="links" href="/viewProduct/{{$offer1->pro_idn}}">COMPRAR AHORA</a>
								</div>
							</div>
						</div>
						<!-- Single Slide Area End Here -->
					</div>
				</div>
			</div>
			<!-- Slider Area End Here -->
			<!-- Begin Li Banner Area -->
			<div class="col-lg-3 col-md-4 text-center pt-sm-30">
				<div class="li-banner   mt-sm-30 mt-xs-25 mb-xs-5" style="height: 101px;border: 2px solid #e1e1e0; background-color: #f7f7f7;">
					<a href="/mercadoPublico">
						<img src="{{ asset('/chilecompra.png') }}" style="padding:20px; width:270px;"  alt="">
					</a>
				</div>
				<div class="li-banner mt-15 mt-sm-30 mt-xs-25 mb-xs-5" style="height:145px;">
					<a href="#">
						<img src="{{ asset('electro/images/banner/3_2.jpg') }}" alt="">
					</a>
				</div>
				<div class="li-banner mt-15 mt-sm-30 mt-xs-25 mb-xs-3" style="height:145px;">
					<a href="#">
						<img src="{{ asset('electro/images/banner/3_2.jpg') }}" alt="">
					</a>
				</div>
			</div>
			<!-- Li Banner Area End Here -->
		</div>
	</div>
</div>

