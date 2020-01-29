<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('titulo', 'Inicio') | Librería Adimel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php if(!isset($resourceLink)) $resourceLink = 'general'; @endphp
    @php if(!isset($resourceScript)) $resourceScript = 'general'; @endphp

    @include('cliente.template.recursos.link', ['resourceLink' => $resourceLink])  
</head>
<body>
    <div class="body-wrapper">
        <header>
            @yield('header')
        </header>
        
        @yield('body')

        <div class="footer">
            @yield('footer')
        </div>
        @yield('modal')

        @include('cliente.template.componentes.modal_login')
    </div>
    @include('cliente.template.recursos.script', ['resourceScript' => $resourceScript])
</body>

</html>


