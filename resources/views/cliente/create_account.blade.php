@extends('cliente.template.app')
@section('titulo', 'Nueva Cuenta')

@section('header')

@include('cliente.template.componentes.header_middle')
@include('cliente.template.componentes.header_bottom')
<!-- Begin Mobile Menu Area -->
<div class="mobile-menu-area d-lg-none d-xl-none col-12">
	<div class="container"> 
		<div class="row">
			<div class="mobile-menu">
			</div>
		</div>
	</div>
</div>
<!-- Mobile Menu Area End Here -->
@endsection

@section('body')

<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				<form action="#">
					<div class="login-form">
						<h4 class="login-title">Crear Nueva Cuenta</h4>
						<div class="row">
							<div class="col-md-12 col-12 mb-20">
								<label>RUT</label>
								<input class="mb-0" type="text" placeholder="12345678-0">
							</div>
							<br>
							<div class="col-md-6 col-md-offset-4 col-12 mb-20">
								<label>Primer Nombre</label>
								<input class="mb-0" type="text" placeholder="">
							</div>
							<div class="col-md-6 col-12 mb-20">
								<label>Segundo Nombre</label>
								<input class="mb-0" type="text" placeholder="">
							</div>
							<div class="col-md-12 mb-20">
								<label>E-mail</label>
								<input class="mb-0" type="email" placeholder="Ingrese su E-mail">
							</div>
							<div class="col-md-6 mb-20">
								<label>Contraseña</label>
								<input class="mb-0" type="password" placeholder="Contraseña">
							</div>
							<div class="col-md-6 mb-20">
								<label>Confirmar Contraseña</label>
								<input class="mb-0" type="password" placeholder="Confirmar Contraseña">
							</div>
							<div class="col-12">
								<button class="register-button mt-0">Registrar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection



@section('footer')

@include('cliente.template.componentes.footer_middle')
@include('cliente.template.componentes.footer_bottom')

@endsection
