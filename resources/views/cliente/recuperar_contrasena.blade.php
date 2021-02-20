@extends('cliente.template.app')
@section('titulo', 'Nueva Cuenta')

@section('header')

@section('body')

<div class="page-section mb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
				<form id="form-recover-account" >
					{{ csrf_field() }}
					<div class="login-form">
						<h4 class="login-title">Recuperar Contraseña</h4>
						<div class="row">
							<input class="mb-0" type="hidden" name="mail_token" value="{{$token}}" id="mail_token">
							<input class="mb-0" type="hidden" name="user_id" id="user_id" value="{{$id}}">

							<div class="form-group col-md-6 mb-20">
								<label>Contraseña</label>
								<input class="mb-0" type="password" name="pw" id="pw" placeholder="Contraseña">
							</div>
							<div class="form-group col-md-6 mb-20">
								<label>Confirmar Contraseña</label>
								<input class="mb-0" type="password" name="pw_confirmation" id="pw_confirmation" placeholder="Confirmar Contraseña">
							</div>
							<div class="col-12">
								<button class="register-button mt-0" type="submit" id="btn-registrar">Guardar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#form-recover-account').submit(function(event) {
		event.preventDefault();
		$form = $(this);
		//$('.register-button').attr("disabled", true);
		//var $inputs = $form.find("input,select");

		$.ajax({
			url: '{{ route("cliente.recuperar_contrasena.store") }}',
			type: 'POST',
			dataType: 'JSON',
			data: $form.serialize(),
		})
		.done(function(data) {
			//console.log(data);
			$('.has-error').removeClass('has-error');
			$('.text-error').remove();
			$('.mi_select').css('border', '1px solid #999999');
			if(data.status) {
				if(data.expired){
					//console.log("xD")
					var html = "<br><br><h4>El tiempo de recuperacion ha expirado, por favor intente nuevamente.</h4>"
					var div = $("#form-recover-account").parent();
					$("#form-recover-account").remove();
					div.append(html);
					return null;
				}
				if(data.errors) {
					let errors = data.errors.original.errors

					$.each(errors , function( index, msj ) {
						//alert( index + ": " + value );
						//console.log(index);
						var elem = $('#'+index);						
						if(elem.is('input')) {
							////console.log(elem);
							$form_group = elem.parent('.form-group');
							$form_group.addClass('has-error');
							html = '';
							html += '<p class="text-error">';
							html += msj;
							html += '</p>';
							$form_group.append(html);
						}
						else {
							////console.log(elem);
							elem.css('border', '1px solid #ff0000');
							$form_group = elem.parent('.form-group');
							$form_group.addClass('has-error');
							html = '';
							html += '<p class="text-error">';
							html += msj;
							html += '</p>';
							$form_group.append(html);
						}
					});

					return null;
				}
				
				var html = "<br><br><h4>Cuenta recuperada con éxito!</h4><h5>Ahora puedes iniciar sesión en Adimel</h5>"
				var div = $("#form-recover-account").parent();
				$("#form-recover-account").remove();
				div.append(html);
			} else {
				
				toastr.error('Error al crear la cuenta, intente mas tarde','Lo sentimos', 
				{
					timeOut: 5000,
					progressBar: true,
					"positionClass": "toast-top-right",
				});
			}
			//$('.register-button').removeAttr('disabled');
		})
		.fail(function() {
			//alert("Fallo conexion al servidor");
			toastr.error('Error al crear la cuenta, intente mas tarde','Lo sentimos', 
			{
				timeOut: 5000,
				progressBar: true,
				"positionClass": "toast-top-right",
			});
			$('.register-button').removeAttr('disabled');
		});	
	});
	});
</script>
@endsection