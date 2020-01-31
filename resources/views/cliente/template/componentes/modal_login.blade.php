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
									<div class="col-md-12 col-12 mb-30 mt-20 form-group">
										<label>RUT</label>
										<input class="mb-0 form-control rut" type="text" name="login_rut" id="login_rut" placeholder="">
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
		$("#form-login").submit(function(event) {			
			event.preventDefault();
			
			$form = $(this);
			var $inputs = $form.find("input");
			var serializedData = $inputs.serialize();
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