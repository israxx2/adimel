<div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Begin Header Bottom Menu Area -->
				<div class="hb-menu hb-menu-2">
					<nav>
						<ul>
							<li ><a href="/">INICIO</a>	</li>
							<li><a href="/quienes-somos">QUIÉNES SOMOS</a></li>
							<li><a href="/contacto">CONTACTO</a></li>
							<li><a href="/mercadoPublico">MERCADO PUBLICO</a></li>

							@if(Auth::guard('cliente')->check())
							
							<li class="hb-info f-right p-0 d-sm-none d-lg-block" onclick="logout();">
								<a href="#"> CERRAR SESIÓN
								</a>
								<form id="logout-form" action="{{ route('cliente.logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
							@else
							<li class="hb-info f-right p-0 d-sm-none d-lg-block">
								<span style="color: #ffffff">{{ Config::get('msj_inicio')->titulo }}</span>
							</li>
							@endif
							<!-- Header Bottom Menu Information Area End Here -->
						</ul>
					</nav>
				</div>
				<!-- Header Bottom Menu Area End Here -->
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('adminlte/dist/js/logout.js') }}" type="text/javascript" charset="utf-8" async defer></script>