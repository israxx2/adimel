<div class="modal fade" id="modal_login" >
	<div class="modal-dialog modal-dialog-centered" style="width: 80% !important;">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-sm-12">
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="container">
								<h4 class="login-title">Iniciar Sesión</h4>
								<div class="row d-flex justify-content-center">
									<div class="col-md-12 col-12 mb-30 mt-20 form-group">
										<label>RUT</label>
										<input class="mb-0 form-control rut" type="text" name="cli_idn" placeholder="EJ: 12345678-0">
									</div>
									<div class="col-12 mb-20 form-group">
										<label>Contraseña</label>
										<input class="mb-0 form-control" name="password" type="password">
									</div>
									<div class="col-md-12 mt-10 text-left text-md-right">
										<a href="{{ route('cliente.create_account') }}">Crear una Cuenta</a>
									</div>
									<div class="col-md-12 mt-10 mb-40 text-left text-md-right">
										<a href="#">¿Olvidaste tu contraseña?</a>
									</div>
									<div class="col-md-12">
										<button class="btn btn-primary btn-block" style="background-color: #0088c6;">Iniciar Sesión</button>
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