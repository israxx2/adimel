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
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" style="margin-left: 20px; margin-bottom: 35px;">
									<label>Correo Electrónico</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">a</span>
										</div>
										<input type="text" class="form-control" placeholder="Ingrese Correo Electrónico...">
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
											<span class="input-group-text">a</span>
										</div>
										<input type="text" class="form-control" placeholder="Ingrese una dirección...">
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
											<span class="input-group-text">a</span>
										</div>
										<input type="text" class="form-control" placeholder="Ingrese un Teléfono...">
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
											<span class="input-group-text">@</span>
										</div>
										<input type="text" class="form-control" placeholder="Ingrese mensaje..." value="Encuéntranos en Calle 6 Ote. 640, Talca, Maule">
									</div>
								</div>
							</div>						
						</div>
						
					</div>
					<div class="card-footer">
						The footer of the card
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

@endsection


@section('script')


@endsection