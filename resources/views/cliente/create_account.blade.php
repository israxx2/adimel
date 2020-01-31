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
							<div class="form-group col-md-12 col-12 mb-20 rut-f">
								<label>RUT</label>
								<input class="mb-0 rut" type="text" name="rut" id="rut" placeholder="">
							</div>
							<br>
							<div class="form-group col-md-6 col-md-offset-4 col-12 mb-20">
								<label>Nombre</label>
								<input class="mb-0" type="text" name="nombre" id="nombre" placeholder="">
							</div>
							<div class="form-group col-md-6 col-12">
								<label>Apellidos</label>
								<input class="mb-0" type="text" name="apellidos" id="apellidos" placeholder="">
							</div>
							<div class="form-group col-md-8">
								<label>E-mail</label>
								<input class="mb-0" type="email" name="email" id="email" placeholder="Ingrese su E-mail">
							</div>
							<div class="form-group col-md-4 ">
								<label>Ciudad</label>
								<select class="nice-select wide" name="id_ciudad" id="id_ciudad">
									<option data-display="Talca">Talca</option>
									<option value="Santiago">Santiago</option>
									<option value="Linares">Linares</option>
									<option value="San Javier">San Javier</option>
								</select>
							</div>
							<div class="form-group col-md-12 col-12 mb-20">
								<label>Dirección</label>
								<input class="mb-0" type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección">
							</div>
							<div class="form-group col-md-6 mb-20">
								<label>Contraseña</label>
								<input class="mb-0" type="password" name="pw" id="pw" placeholder="Contraseña">
							</div>
							<div class="form-group col-md-6 mb-20">
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

@endsection

@section('script')
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
	});
	$('#form-create-account').submit(function(event) {
		event.preventDefault();
		$form = $(this);

		//$('.is-invalid').removeClass('is-invalid');
		//$('.text-error').text("");
		//$('.register-button').attr("disabled", true);
		$('.register-button').attr("disabled", true);
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
			$('.has-error').removeClass('has-error');
			$('.text-error').remove();
			if(data.status) {
				if(data.errors == null) {
					//YA EXISTE
					if(Boolean(data.existe)) {
						toastr.error('El rut ya está en uso.', 'Ups...', 
						{
							timeOut: 5000,
							progressBar: true,
							"positionClass": "toast-bottom-right",
						});
						$form_group = $('.rut-f');
						console.log($form_group);
						$form_group.addClass('has-error');
						var html = '<p class="text-error">El rut ya está en uso!</p>';
						$form_group.append(html);
					} else {
						toastr.success('Inicia sesión con tus datos', 'CUENTA CREADA!', 
						{
							timeOut: 5000,
							progressBar: true,
							"positionClass": "toast-bottom-right",
						});
						var html = "<br><br><h4>Cuenta creada con éxito!</h4><h5>Ahora puedes iniciar sesión para comprar en Adimel</h5>"
						var div = $("#form-create-account").parent();
						$("#form-create-account").remove();
						div.append(html);
					}
					//ERRORES DE VALIDACIÓN
				}  else {
					var errors = data.errors.original.errors

					$.each(errors , function( index, msj ) {
						//alert( index + ": " + value );
						var elem = $('#'+index);						
						if(elem.is('input')) {
							$form_group = elem.parent('.form-group');
							$form_group.addClass('has-error');
							html = '';
							html += '<p class="text-error">';
							html += msj;
							html += '</p>';
							$form_group.append(html);
						}
					});
				}
				
			} else {
				alert("Ups... Ha ocurrido un error en nuestros servidores");
			}
			$('.register-button').removeAttr('disabled');
		})
		.fail(function() {
			alert("Fallo conexion al servidor");
			$('.register-button').removeAttr('disabled');
		});	
	});
</script>
@endsection