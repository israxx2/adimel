@extends('cliente.template.app')
@section('titulo', 'Inicio')


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


