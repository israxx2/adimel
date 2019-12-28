<link rel="stylesheet" href="{{ asset('electro/style.css') }}">
<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">

@extends('admin.template.app')
@section('title', 'Productos')
@section('content')

<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
	'header' => [
		'icon'	=> 'fas fa-archive',
		'title' => 'Productos'
		],
	'pages' => [
		['title' => 'Inicio', 'href' => route('admin')],
		['title' => 'Productos']
	]
	])
<!-- /.content-header -->


<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Main content -->
<style>
	input[type="file"] {
		display: none;
	}
	.custom-file-upload {
		display: inline-block;
		padding: 6px 12px;
		cursor: pointer;
	}
</style>


<section class="content">
	<div class="container-fluid">
		<div class="container">
              <div class="panel-body">
                  <div class="row">
					<div class="col-md-2 text-center" style="padding:10px;">
                     <label class="custom-file-upload btn btn-block btn-xl btn-info" style="padding: 10px; top:30%; position:relative;">
							<input type="file" id="upload"/>
							SELECCIONAR
						</label>
						<button class="btn btn-success btn-xl btn-block upload-result" style="padding: 10px; top:30%; position:relative;">
							<strong>GUARDAR</strong>
						</button>
					</div>

					<div class="col-lg-3 col-md-4 col-sm-6 mt-40">
						<div class="card">
							<div class="product-image" >
									<div id="upload-demo"  style="padding:20px; display:none;">
										
									</div>
									<div id="imagen"  style="padding:10px;">
										<center>
											@if (file_exists('imageProducts/'.$p->pro_idn.'.png'))
												<img src="{{ asset('imageProducts/'.$p->pro_idn.'.png') }}" width="240px" height="240px" alt="Product Image">
											@else
												<img src="{{ asset('imageProducts/noimage.png') }}" width="240px" height="240px" alt="Product Image">
											
											@endif
										</center>
									</div>
								
								</div>
							<div class="product_desc">
								<div class="product_desc_info" style="padding:20px;">
									<h4><a class="product_name" href="/viewProduct/{{$p->pro_idn}}">{{$p->pro_nombre}}</a></h4>
									<div class="price-box">
										<span class="new-price">${{$p->pro_valor_venta1}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				
                  </div>
              </div>
        </div>
	</div>
</section>

@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script>

<script type="text/javascript">
        
        
	$.ajaxSetup({

		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});

    $uploadCrop = $('#upload-demo').croppie({
    
        enableExif: true,
        viewport: {
            width: 270,
            height: 270,
            type: 'square'
        },
        boundary: {
            width: 270,
            height: 270
        }
    
    });

    
    
    $('#upload').on('change', function () { 
    
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            });	
        }
        reader.readAsDataURL(this.files[0]);
		
		
		document.getElementById("imagen").style.display = "none"; 
		document.getElementById("upload-demo").style.display = "inline"; 
	
    
    });

    
    
    $('.upload-result').on('click', function (ev) {
    
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
    
        }).then(function (resp) {
    
            $.ajax({
                url: "/admin/imagen",
                type: "POST",
                data: {"image":resp, "id":window.location.pathname.split("/")[3]},
                success: function () {
                 

					document.getElementById("upload-demo").style.display = "none"; 
					html = '<img src="' + resp + '" width="240px" height="240px"  />';
					$("#imagen").html(html);
					document.getElementById("imagen").style.display = "inline"; 
				}
            });
        });
    });
    
    
    </script>

@endsection