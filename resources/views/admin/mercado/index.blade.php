@extends('admin.template.app')

@section('title', 'Mercado')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
'header' => [
'icon'	=> 'fas fa-archive',
'title' => 'Mercado Público'
],
'pages' => [
['title' => 'Inicio', 'href' => route('admin')],
['title' => 'Mercado']
]
])
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <center>
        <img src="{{ asset('mercadobanner.png') }}">
    </center>

    <hr>

    <div class="row">
        <div class="col-lg-6">
            <center>
                <div class="shipping-text">
                    <h2>LISTA DE PRODUCTOS</h2>
                </div>
                <small> <i>Haga click en la imagen para subir lista de "PRODUCTOS": </i></small><br>
                <span class="hiddenFileInput imagen1">
                    <input type="file" id="lista_productos"/>
                </span><br><br>
                <button onclick="subirProductos()" class="btn btn-success btn-xl save" >GUARDAR</button>
            </center>
        </div>
        <div class="col-lg-4">



            <center>
                <div class="shipping-text">
                    <h2>OFERTAS CONVENIO MARCO</h2>
                </div>
                <small> <i>Haga click en la imagen para subir lista de "OFERTAS CONVENIO MARCO": </i></small><br>

                <span class="hiddenFileInput imagen2">
                    <input type="file" id="lista_ofertas"/>
                </span><br><br>
                <button onclick="subirOfertas()" class="btn btn-success btn-xl save">GUARDAR</button>

            </center>
        </div>
    </div>

</section>

@endsection

<style>
.hiddenFileInput > input{
    height: 100%;
    width: 100;
    opacity: 0;
    cursor: pointer;
}
.hiddenFileInput{
    border: 1px solid #ccc;
    width: 100px;
    height: 100px;
    display: inline-block;
    overflow: hidden;
    cursor: pointer;
    
    /*for the background, optional*/
    background: center center no-repeat;
    background-size: 75% 75%;
    
}
.imagen1{
    background-image:  url({{ asset('listdownload.png') }})
}
.imagen2{
    background-image:  url({{ asset('offer.png') }})
}
</style>


@section('script')


<script type="text/javascript">


    function subirOfertas(){

        let file = document.getElementById('lista_ofertas').files[0];
        var formData = new FormData();
        formData.append('file', file);
        formData.append('tipo', "ofertas");
        subirarchivo(formData);
    }
    function subirProductos(){

        let file = document.getElementById('lista_productos').files[0];
        var formData = new FormData();
        formData.append('file', file);
        formData.append('tipo', "productos");
        subirarchivo(formData);
    }

    function subirarchivo(formData){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/adimel/uploadfile",
            type: "POST",
            data:  formData,
            cache: false,
            processData: false,
            contentType : false,
            success: function () {
                console.log("si")
                toastr.success('Se ha guardado con éxito!', 'MERCADO PÚBLICO', 
                {
                    timeOut: 5000,
                    progressBar: true,
                    "positionClass": "toast-top-right",
                });
            }
        });

    }

</script>
@endsection