@extends('cliente.template.app')
@section('titulo', 'Nueva Cuenta')

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

<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				<form id="form-create-account">
					{{ csrf_field() }}
					<div class="login-form">
						<h4 class="login-title">Crear Nueva Cuenta</h4>
						<div class="row">
							<div class="col-sm-12">
								<p>Se ha asociado su cuenta WEB con sus datos ya almacenados en nuestra base de datos</p>
							</div>
							<div class="col-md-12 col-12 mb-20">
								<label>RUT</label>
								<input class="mb-0" type="text" name="rut" id="rut" placeholder="12345678-0">
							</div>
							<br>
							<div class="col-md-6 col-md-offset-4 col-12 mb-20">
								<label>Nombre</label>
								<input class="mb-0" type="text" name="nombre" id="nombre" placeholder="">
							</div>
							<div class="col-md-6 col-12 mb-20">
								<label>Apellidos</label>
								<input class="mb-0" type="text" name="apellidos" id="apellidos" placeholder="">
							</div>
							<div class="col-md-12 mb-20">
								<label>E-mail</label>
								<input class="mb-0" type="email" name="email" id="email" placeholder="Ingrese su E-mail">
							</div>
							<div class="col-md-6 mb-20">
								<label>Contraseña</label>
								<input class="mb-0" type="password" name="pw" id="pw" placeholder="Contraseña">
							</div>
							<div class="col-md-6 mb-20">
								<label>Confirmar Contraseña</label>
								<input class="mb-0" type="password" name="pw_confirmation" placeholder="Confirmar Contraseña">
							</div>
							<div class="col-12">
								<button class="register-button mt-0">Registrar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection



@section('footer')

@include('cliente.template.componentes.footer_middle')
@include('cliente.template.componentes.footer_bottom')

@endsection

@section('script')
<script type="text/javascript">

	$('#form-create-account').submit(function(event) {
		event.preventDefault();
		$form = $(this);

		//$('.is-invalid').removeClass('is-invalid');
		//$('.text-error').text("");
		//$('.register-button').attr("disabled", true);

		var $inputs = $form.find("input");

		var serializedData = $inputs.serialize();
		$.ajax({
			url: '{{ route("cliente.create_account.store") }}',
			type: 'POST',
			dataType: 'JSON',
			data: serializedData,
		})
		.done(function(data) {
			console.log(data);
			// if(data.status) {
			// 	if(data.errors == null) {
			// 		$('.btn').attr("disabled", true);
			// 		window.location.href = '{{ route("cliente.inicio") }}';
			// 	} else {
			// 		$.notify({
			// 			title: '<i class="fa fa-fw fa-exclamation"></i><strong> Ups...</strong><br/>',
			// 			message: "Ingrese correctamente los campos correctamente",
			// 		},{
			// 			z_index: 2000,
			// 			type: 'danger',
			// 			animate: {
			// 				enter: 'animated fadeInUp',
			// 				exit: 'animated fadeOutRight'
			// 			},
			// 			placement: {
			// 				from: "top",
			// 				align: "right"
			// 			},
			// 		});
			// 		var errors = data.errors.original.errors

			// 		for(error in errors){
			// 			var elem = $('#'+error);
			// 			if(elem.is('input')) {
			// 				elem.addClass("is-invalid");
			// 				elem.parent().parent().find("small").find("p").text(errors[error]);
			// 			} else if(elem.is("select")) {
			// 				elem.addClass("is-invalid");
			// 				elem.parent().find("small").find("p").text(errors[error]);
			// 			}

			// 		}
			// 		$('.btn').removeAttr('disabled');
			// 	}
			// } else {
			// 	$.notify({
			// 		title: '<i class="fa fa-fw fa-exclamation"></i><strong> Ups...</strong><br/>',
			// 		message: "Ha ocurrido un problema con el servidor",
			// 	},{
			// 		z_index: 2000,
			// 		type: 'danger',
			// 		animate: {
			// 			enter: 'animated fadeInUp',
			// 			exit: 'animated fadeOutRight'
			// 		},
			// 		placement: {
			// 			from: "top",
			// 			align: "right"
			// 		},
			// 	});
			// 	$('.btn').removeAttr('disabled');
			// }

		})
		.fail(function() {
			console.log("salio mal");
			$.notify({
				title: '<i class="fa fa-fw fa-exclamation"></i><strong> Ups...</strong><br/>',
				message: "Ha ocurrido un problema con el servidor",
			},{
				type: 'danger',
				animate: {
					enter: 'animated fadeInUp',
					exit: 'animated fadeOutRight'
				},
				placement: {
					from: "top",
					align: "right"
				},
			});
			$('.btn').removeAttr('disabled');
		});

		
		
	});
</script>
@endsection