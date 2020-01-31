

@extends('cliente.template.app')
@section('titulo', 'Carrito')


@section('body')

	@include('cliente.template.componentes.breadcrumb_area', ['pages' => ['Inicio', 'Carrito']])

	@include('cliente.template.componentes.cart.cart')

@endsection
