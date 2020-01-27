@extends('admin.template.app')

@section('title', 'Configuración')

@section('content')
<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
'header' => [
'icon'	=> 'fa fa-fw fa-cog',
'title' => 'Configuración'
],
'pages' => [
['title' => 'Inicio', 'href' => route('admin')],
['title' => 'Configuración']
]
])

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Editar Configuración</h3>
					</div>
					<form method="POST" action="{{ route('admin.configuracion.store') }}">
						<div class="card-body">
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin-left: 20px; margin-bottom: 35px;">
										<label>Correo Electrónico</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-envelope"></i></span>
											</div>
											<input type="text" class="form-control" name="correo" placeholder="Ingrese Correo Electrónico..." value="{{ Config::get('correo')->titulo }}">
										</div>
									</div>
								</div>						
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin-left: 20px; margin-bottom: 35px;">
										<label>Dirección</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-home"></i></span>
											</div>
											<input type="text" class="form-control" name="direccion" placeholder="Ingrese una dirección..." value="{{ Config::get('direccion')->titulo }}">
										</div>
									</div>
								</div>						
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin-left: 20px; margin-bottom: 35px;">
										<label>Teléfono</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
											</div>
											<input type="text" class="form-control" name="telefono" placeholder="Ingrese un Teléfono..." value="{{ Config::get('telefono')->titulo }}">
										</div>
									</div>
								</div>						
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group" style="margin-left: 20px; margin-bottom: 35px;">
										<label>Mensaje Barra Inicio</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-book-open"></i></span>
											</div>
											<input type="text" class="form-control" name="msj_inicio" placeholder="Ingrese mensaje..." value="{{ Config::get('msj_inicio')->titulo }}">
										</div>
									</div>
								</div>						
							</div>

						</div>

					
					<div class="card-footer">
						<div class="container-fluid">
							<div class="row d-flex justify-content-center">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-flat btn-primary btn-block">Registrar</button>
								</div>
							</div>								
						</div>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</section>

@endsection


@section('script')


@endsection