@extends('cliente.template.app')
@section('titulo', 'Inicio')

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

	@include('cliente.template.componentes.slider', ['categorias' => $categorias])
	@include('cliente.template.componentes.static_banner_1')

	<div class="content-wrapper pt-60 pb-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					@include('cliente.template.componentes.product_list') 
				</div>
			</div>
		</div>
	</div>

@endsection

@section('footer')

	@include('cliente.template.componentes.footer_middle')

@endsection

