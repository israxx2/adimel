<div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
	<div class="container">
		<div class="row">
			<!-- Begin Header Logo Area -->
			<div class="col-lg-3">

				<div class="logo pb-sm-30 pb-xs-30">
					<a href="/">
						<center>
							<img src="{{ asset('logo_adimel4.jpg') }}" style="height: 70px;"  alt="logo adimel">
						</center>
					</a>
				</div>
			</div>
			<!-- Header Logo Area End Here -->
			<!-- Begin Header Middle Right Area -->
			<div class="col-lg-9" style="padding-top:10px">
				<!-- Begin Header Middle Searchbox Area -->
				<form action="#" id="buscar" class="hm-searchbox">
					{{-- <select class="nice-select select-search-category" onchange="changeCategoria(this)"> --}}
						<select class="nice-select select-search-category" id="categoria" >
							<option value="0" selected>TODOS</option> 
							@foreach($categorias as $c)
							<option value={{$c->rub_idn}}>{{strtoupper($c->rub_nombre)}}</option>  
							@endforeach
						</select>
						<input type="text" id="texto" placeholder="Buscar un articulo ...">
						<button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
					<!-- Header Middle Searchbox Area End Here -->


					<!-- Begin Header Middle Right Area -->
					<div class="header-middle-right">
						<ul class="hm-menu">
							<!-- Begin Header Mini Cart Area -->
							<li class="hm-minicart"  >
								<div class="hm-minicart-trigger" style="background-color:#0088C6">
									<span class="item-icon"></span>
									<span class="item-text" ><span id="subtotal1">$0</span>
									<span id="cantidad" class="cart-item-count" style="background-color:#ffdc04; color:#0088C6 "><b>0</b></span>
								</span>
							</div>
							<span></span>
							<div class="minicart">
								<ul class="minicart-product-list">
									
								</ul>
								<p class="minicart-total">SUBTOTAL: <span id="subtotal2">$0</span></p>
								<div class="minicart-button">
									<a href="/cart" class="li-button li-button-dark li-button-fullwidth li-button-sm">
										<span>VER CARRO</span>
									</a>
									<a href="/checkout" class="li-button li-button-fullwidth li-button-sm">
										<span>COMPRAR</span>
									</a>
								</div>
							</div>
						</li>
						<!-- Header Mini Cart Area End Here -->
					</ul>
				</div>
				<!-- Header Middle Right Area End Here -->

				<!-- Begin Header Middle Right Area -->

				<div class="header-middle-right">
					<button class="li-btn-2" data-toggle="modal" data-target="#modal_login"><span>Iniciar Sesión</span></button>
				</div>

				<!-- Header Middle Right Area End Here -->

				


			</div>
			<!-- Header Middle Right Area End Here -->
		</div>
	</div>
</div>

<div style="position:fixed; top:303px; z-index:10000; right:17px">
	<button class="btn btn-xs" style="background:#1BD741" onclick="location.href='http://web.whatsapp.com/send?text=&phone=+56982226526&abid=+56982226526'">
		<i class="fa fa-whatsapp"style="font-size:35px; color:#fff" ></i>
	</button>
	
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

	function changeCategoria(e){
		location.href="/categoria/"+e.value
	}

	$("#buscar").submit(function( e ) {
		e.preventDefault();
		let categoria=$("#categoria").val();
		let texto=$("#texto").val();
		console.log(texto)


	});

</script>