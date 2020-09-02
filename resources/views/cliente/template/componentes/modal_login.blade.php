<div class="modal fade" id="modal_login" >
	<div class="modal-dialog modal-dialog-centered" style="width: 80% !important;">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-sm-12">
						<form method="POST" action="{{ route('cliente.login') }}" id="form-login">
							@csrf
							<div class="container">
								<center><h4 class="login-title">Iniciar Sesión</h4></center>
								<div class="row d-flex justify-content-center">
									<div class="col-md-12 col-12 mt-20 form-group mt-20">
										<label>RUT</label>
										<input class="mb-0 form-control rut" type="text" name="login_rut" id="login_rut" placeholder="">
									</div>
									<div id="sucursal" name="sucursal" class="col-md-12 col-12 mb-20 form-group" style="display: none;">
										<label>Sucursal</label>
										<select class="mi_select" name="dependencias" id="dependencias">
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
										<a href="#">¿Olvidaste tu contraseña?</a>
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

		$('.rut').on("change", function(e) {
			state.rut = $(this).val();
			console.log("largo = " + "string: " + state.rut.replace(/\./g,'').replace('-',''));
			console.log(state.rut);
			console.log("string: " + state.rut.replace('.','').replace('-',''));
			if(state.rut.length >= 9) {
				$('#form-login btn-block').attr('disabled', true);
				$.ajax({
					url: "{{ route('api.get_dependencias') }}",
					type: 'POST',
					dataType: 'JSON',
					data: {
						"_token": "{{ csrf_token() }}",
						"rut": state.rut
					},
				})
				.done(function(data) {
					console.log(data.dependencias);
					if(data.status) {
						if(data.dependencias.length > 1) {
							var html = "<option selected disabled>Seleccione una dependencia</option>";
							$.each(data.dependencias, function(index, value) {
								console.log(value);
								html += '<option value='+value.idn+'>'+value.nombre+'</option>';
							});
							$('#dependencias').empty().append(html);
							$('#sucursal').show(400);

						} else {
							$('#sucursal').hide(400);
							$('#dependencias option').empty();
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
	});
</script>