@extends('cliente.template.app')
@section('titulo', 'Quienes Somos')

@section('body')

	@include('cliente.template.componentes.breadcrumb_area', ['pages' => ['Inicio', '¿Quienes Somos?']])
	@include('cliente.template.componentes.about')

@endsection

