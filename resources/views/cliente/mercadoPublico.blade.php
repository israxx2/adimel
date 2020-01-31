@extends('cliente.template.app')
@section('titulo', 'Inicio')



@section('body')
	@include('cliente.template.componentes.breadcrumb_area', ['pages' => ['Inicio', 'Mercado Publico']])
	@include('cliente.template.componentes.mercadoPublico.mercadopublico')
	@include('cliente.template.componentes.mercadoPublico.listas')

@endsection


