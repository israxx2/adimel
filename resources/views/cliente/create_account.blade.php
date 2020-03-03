@extends('cliente.template.app')
@section('titulo', 'Nueva Cuenta')

@section('header')

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

							<div class="form-group col-md-4">
								<label>Teléfono</label>
								<input class="mb-0" type="text" name="telefono" id="telefono" placeholder="(8 dígitos)">
							</div>
							
							<div class="form-group col-md-6 ">
								<label>Region</label>
								<select class="mi_select " name="id_region" id="id_region" onchange="changeRegion(this)">
									@foreach($regiones as $r)
										<option value="{{ $r->div_pol_idn }}">{!! ucwords(strtolower(htmlentities($r->div_pol_nombre))) !!}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6 ">
								<label>Ciudad</label>
								<select class="mi_select " name="id_ciudad" id="id_ciudad" >
									<option disabled>Seleccione una Ciudad</option>
								</select>
							</div>
							<div class="form-group col-md-8 col-12 mb-20">
								<label>Dirección</label>
								<input class="mb-0" type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección">
							</div>

							<div class="form-group col-md-4 col-12 mb-20">
								<label>Número</label>
								<input class="mb-0" type="text" name="numero" id="numero" placeholder="Casa, Dpto, etc...">
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

{{-- <div class="row" style="justify-content: center;">
	<div class="col-sm-6">
		<p>id's: 1, 2, 3, 4, ....</p>
		<input type="text" name="id_test" id="id_test" value="10">
		<center><button class="btn btn-primary" id="test">Test Ajax Ciudades</button></center>
		<p>Ingresar id region. ver consola para retorno de ciudades</p>
		<ul id="cont_ciudades">
		</ul>
	</div>
</div> --}}
@endsection


<style>
	.mi_select{
		width: 100%;
		background-color:transparent;
		border: 1px solid #999999;
		border-radius: 0;
		line-height: 23px;
		padding: 10px 20px;
		font-size: 14px;
		height: 45px;
		color:#7a7a7a;
		margin-bottom: 15px;
}
</style>
@section('script')
<script type="text/javascript">

	function changeRegion(e){
		let id_region= e.value
		url = '{{ route("api.ciudades", ["id_region" => ":id_region"]) }}'
		url = url.replace(":id_region", id_region);
		$('#id_ciudad').attr('disabled', true);
		$('#id_ciudad').val('');
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
		})
		.done(function(data) {		
			var html = '';
			console.log(data);			
			$.each(data, function(index, value) {

				console.log(value);
				html += '<option value='+value.seg_div_pol_idn+'>'+value.seg_div_pol_nombre+'</option>';
			});
			$('#id_ciudad').empty().append(html);

			$('#id_ciudad').attr('disabled', false);
			
		});
		

	}


	$('#form-create-account').submit(function(event) {
		event.preventDefault();
		$form = $(this);

		//$('.is-invalid').removeClass('is-invalid');
		//$('.text-error').text("");
		//$('.register-button').attr("disabled", true);
		$('.register-button').attr("disabled", true);
		var $inputs = $form.find("input,select");

		var serializedData = $inputs.serialize();
		$.ajax({
			url: '{{ route("cliente.create_account.store") }}',
			type: 'POST',
			dataType: 'JSON',
			data: serializedData,
		})
		.done(function(data) {
			//console.log(data);
			$('.has-error').removeClass('has-error');
			$('.text-error').remove();
			$('.mi_select').css('border', '1px solid #999999');
			if(data.status) {
				if(data.errors == null) {
					//YA EXISTE
					if(Boolean(data.existe)) {
						toastr.error('El rut ya está en uso, intente nuevamente', 'Lo sentimos', 
						{
							timeOut: 5000,
							progressBar: true,
							"positionClass": "toast-top-right",
						});
						$form_group = $('.rut-f');
						// console.log($form_group);
						$form_group.addClass('has-error');
						var html = '<p class="text-error">El rut ya está en uso!</p>';
						$form_group.append(html);
					} else {
						toastr.success('Inicia sesión con tus datos', 'CUENTA CREADA', 
						{
							timeOut: 5000,
							progressBar: true,
							"positionClass": "toast-top-right",
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
							console.log(elem);
							$form_group = elem.parent('.form-group');
							$form_group.addClass('has-error');
							html = '';
							html += '<p class="text-error">';
							html += msj;
							html += '</p>';
							$form_group.append(html);
						}
						else {
							console.log(elem);
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
				}
				
			} else {
				
				toastr.error('Error al crear la cuenta, intente mas tarde','Lo sentimos', 
				{
					timeOut: 5000,
					progressBar: true,
					"positionClass": "toast-top-right",
				});
			}
			$('.register-button').removeAttr('disabled');
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
</script>
@endsection