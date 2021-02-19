<div class="modal fade" id="modal_login" >
	<div class="modal-dialog modal-dialog-centered" style="width: 80% !important;">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-sm-12" id="div-form-login">
						<form method="POST" action="{{ route('cliente.login') }}" id="form-login">
							@csrf
							<div class="container">
								<center><h4 class="login-title">Iniciar Sesión</h4></center>
								<div class="row d-flex justify-content-center">
									<div class="col-md-12 col-12 mt-20 form-group mt-20">
										<label>RUT</label>
										<input class="mb-0 form-control rut" type="text" name="login_rut" id="login_rut" placeholder="">
									</div>
									<div id="login_sucursal" class="col-md-12 col-12 mb-20 form-group" style="display: none;">
										<label>Sucursal</label>
										<select class="mi_select" name="dependencias" id="login_dependencias">
										</select>
									</div>
									<div class="col-12 mb-20 form-group">
										<label>Contraseña</label>
										<input class="mb-0 form-control" name="login_pw" id="login_pw" type="password">
									</div>
									<div class="col-md-12 mt-10 text-left text-md-right">
										<a href="{{ route('cliente.create_account') }}">Crear una Cuenta</a>
									</div>
									<div class="col-md-12 mt-10 mb-40 text-left text-md-right">
										<a href="#" id="olvidar">¿Olvidaste tu contraseña?</a>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-block" style="background-color: #0088c6;">
											Iniciar Sesión
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-12" id="div-form-recuperar" style="display: none; ">
						<form method="POST" action="{{ route('cliente.recuperar') }}" id="form-login">
							@csrf
							<div class="container">
								<center><h4 class="login-title">Recuperar Contraseña</h4></center>
								<div class="row d-flex justify-content-center">
									<div class="col-md-12 col-12 mt-20 form-group mt-20">
										<label>RUT</label>
										<input class="mb-0 form-control rut" type="text" name="login_rut" id="login_rut" placeholder="">
									</div>
									<div id="login_sucursal_r" class="col-md-12 col-12 mb-20 form-group" style="display: none;">
										<label>Sucursal</label>
										<select class="mi_select" name="dependencias" id="login_dependencias_r">
										</select>
									</div>

									<div class="col-sm-12">
										<p>Se le enviará un correo electrónico al correo asociado al rut. Revise su bandeja de entrada.</p>
									</div>
									<div class="col-md-12 mt-10 mb-40 text-left text-md-right">
										<a href="#" id="iniciar">Iniciar Sesión</a>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-block" style="background-color: #0088c6;">
											Enviar
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var state = {
			"rut": null
		}

		$('#login_rut').on("change", function(e) {
			console.log("cambio la lesera");
			let rut = this.value.replace(/\./g, '').replace('-', '');

			if (rut.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
				rut = rut.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
			}
			else if (rut.match(/^(\d)(\d{3}){2}(\w{0,1})$/)) {
				rut = rut.replace(/^(\d)(\d{3})(\d{3})(\w{0,1})$/, '$1.$2.$3-$4');
			}
			else if (rut.match(/^(\d)(\d{3})(\d{0,2})$/)) {
				rut = rut.replace(/^(\d)(\d{3})(\d{0,2})$/, '$1.$2.$3');
			}
			else if (rut.match(/^(\d)(\d{0,2})$/)) {
				rut = rut.replace(/^(\d)(\d{0,2})$/, '$1.$2');
			}
			console.log("rut: " + rut);

			if(rut.length >= 11) {
				console.log("entrooo");
				$('#form-login btn-block').attr('disabled', true);
				$.ajax({
					url: "{{ route('api.get_dependencias_web') }}",
					type: 'POST',
					dataType: 'JSON',
					data: {
						"_token": "{{ csrf_token() }}",
						"rut": rut
					},
				})
				.done(function(data) {
					console.log(data);
					if(data.status) {
						if(data.dependencias.length > 1) {
							var html = "<option selected disabled>Seleccione una dependencia</option>";
							$.each(data.dependencias, function(index, value) {
								console.log(value);
								html += '<option value='+value.idn+'>'+value.nombre+'</option>';
							});
							$('#login_dependencias').empty().append(html);
							$('#login_sucursal').show(400);

						} else {
							$('#login_sucursal').hide(400);
							$('#login_dependencias option').empty();
						}
					}
				})
				.fail(function(data) {
					console.log(data);
				}).always(function() {
					$('#form-login btn-block').attr('disabled', false);
				});

			} else {
				$('#sucursal').hide(400);
			}
		}); 

		$('#login_rut_r').on("change", function(e) {
			console.log("cambio la lesera");
			let rut = this.value.replace(/\./g, '').replace('-', '');

			if (rut.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
				rut = rut.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
			}
			else if (rut.match(/^(\d)(\d{3}){2}(\w{0,1})$/)) {
				rut = rut.replace(/^(\d)(\d{3})(\d{3})(\w{0,1})$/, '$1.$2.$3-$4');
			}
			else if (rut.match(/^(\d)(\d{3})(\d{0,2})$/)) {
				rut = rut.replace(/^(\d)(\d{3})(\d{0,2})$/, '$1.$2.$3');
			}
			else if (rut.match(/^(\d)(\d{0,2})$/)) {
				rut = rut.replace(/^(\d)(\d{0,2})$/, '$1.$2');
			}
			console.log("rut: " + rut);

			if(rut.length >= 11) {
				$('#form-login btn-block').attr('disabled', true);
				$.ajax({
					url: "{{ route('api.get_dependencias_web') }}",
					type: 'POST',
					dataType: 'JSON',
					data: {
						"_token": "{{ csrf_token() }}",
						"rut": rut
					},
				})
				.done(function(data) {
					console.log(data);
					if(data.status) {
						if(data.dependencias.length > 1) {
							var html = "<option selected disabled>Seleccione una dependencia</option>";
							$.each(data.dependencias, function(index, value) {
								console.log(value);
								html += '<option value='+value.idn+'>'+value.nombre+'</option>';
							});
							$('#login_dependencias_r').empty().append(html);
							$('#login_sucursal_r').show(400);

						} else {
							$('#login_sucursal_r').hide(400);
							$('#login_dependencias_r option').empty();
						}
					}
				})
				.fail(function(data) {
					console.log(data);
				}).always(function() {
					$('#form-recuperar btn-block').attr('disabled', false);
				});

			} else {
				$('#sucursal_r').hide(400);
			}
		}); 

		$("#form-login").submit(function(event) {			
			event.preventDefault();
			
			$form = $(this);
			var $inputs = $form.find("input, select");
			var serializedData = $form.serialize();
			$('.has-error').removeClass('has-error');
			$('.text-error').remove();
			$.ajax({
				url: "{{ route('cliente.login') }}",
				type: 'POST',
				dataType: 'json',
				data: serializedData
			}).done(function(data) {
				if(data.status == true) {
					if(data.errors == null) {
						location.reload();
					} else {
						var errors = data.errors.original.errors;
						$.each(errors , function( index, msj ) {
							var elem = $('#'+index);						
							if(index == 'login_rut') {
								$form_group = elem.closest('.form-group');
								$form_group.addClass('has-error');
								var html = '<p class="text-error">Las credenciales no coinciden con nuestros registros.</p>';
								$form_group.append(html);
								elem = $('#login_pw');
								$form_group = elem.parent('.form-group');
								$form_group.addClass('has-error');
							}
							if(index == 'login_pw') {
								$form_group = elem.parent('.form-group');
								$form_group.addClass('has-error');
								html = '';
								html += '<p class="text-error">';
								html += msj;
								html += '</p>';
								$form_group.append(html);
							}
							if(index == 'dependencias') {
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
					toastr.error('Ha ocurrido un problema con el servidor, refresque la página.', 'Ups...', 
					{
						timeOut: 5000,
						progressBar: true,
						"positionClass": "toast-bottom-right",
					});
				}
			});
			
		});

		$('#olvidar').click(function(e) {
			e.preventDefault();

			$('#div-form-login').hide();
			$('#div-form-recuperar').show();

		})

		$('#iniciar').click(function(e) {
			e.preventDefault();

			$('#div-form-login').show();
			$('#div-form-recuperar').hide();

		})
	});
</script>