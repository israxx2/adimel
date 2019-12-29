@extends('cliente.template.app')
@section('titulo', 'Quienes Somos')

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

    @include('cliente.template.componentes.filterProducts.index')


@endsection
@section('footer')

    @include('cliente.template.componentes.footer_middle')
    @include('cliente.template.componentes.footer_bottom')

@endsection
