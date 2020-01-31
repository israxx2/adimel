@extends('cliente.template.app')
@section('titulo', 'Productos')


	@section('body')

		@include('cliente.template.componentes.detailsProduct.Details')

		@include('cliente.template.componentes.detailsProduct.Similary')

	@endsection
