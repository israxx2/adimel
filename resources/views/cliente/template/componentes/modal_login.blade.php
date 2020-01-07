<div class="modal fade modal-wrapper" id="modal_login" >
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-inner-area row">
					<div class="col-sm-12">
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="">
								<h4 class="login-title">Iniciar Sesión</h4>
								<div class="row">
									<div class="col-md-12 col-12 mb-20 form-group">
										<label>RUT</label>
										<input class="mb-0 form-control" type="text" name="cli_idn" placeholder="EJ: 12345678-0">
									</div>
									<div class="col-12 mb-20 form-group">
										<label>Contraseña</label>
										<input class="mb-0 form-control" name="dep_cli_clave_web" type="password">
									</div>
									<div class="col-md-12 mt-10 mb-20 text-left text-md-right">
										<a href="#">¿Olvidaste tu contraseña?</a>
									</div>
									<div class="col-md-12">
										<button class="btn btn-primary" style="background-color: #0088c6;">Iniciar Sesión</button>
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