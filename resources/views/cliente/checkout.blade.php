

@extends('cliente.template.app')
@section('titulo', 'Comprar')


@section('body')

@include('cliente.template.componentes.breadcrumb_area', ['pages' => ['Inicio', 'Checkout']])

@include('cliente.template.componentes.cart.checkout')

@endsection
