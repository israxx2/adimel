@extends('admin.template.app')

@section('title', 'Productos')

@section('content')

<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
'header' => [
'icon'	=> 'fas fa-archive',
'title' => 'Productos'
],
'pages' => [
['title' => 'Inicio', 'href' => route('admin')],
['title' => 'Productos']
]
])
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row" id="row_productos">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Lista de Productos Web</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mostrar</label>
									<select id="show_record" class="form-control select2" style="width: 100%">
										<option value="10">10 registros</option>
										<option value="25">25 registros</option>
										<option value="50">50 registros</option>
										<option value="100">100 registros</option>
										<option value="-1">Todos los registros</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Buscar</label>
									<input id="search_input" class="form-control" placeholder="Por: Nombre, Apellido, Correo, etc...">
								</div>
							</div>
						</div>
						<table id="producto_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Stock</th>
									<th>Acción</th>
								</tr>
							</thead>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>

	</div>
</section>

@endsection

@section('script')
<script type="text/javascript">
	var table;

	$(document).ready(function() {


		$('[data-toggle="tooltip"]').tooltip();

		$('.overlay').show();

		table = $('#producto_table').DataTable({
			"processing": true,
				//"serverSide": true,
				"ajax": {
					"url": "{{ route('api.proveedor.datatable') }}"
				},
				"columns":[
				{"data": "pro_codigo"},
				{"data": "pro_nombre"},
				{"data": "pro_stock"},
				{"render" : function (data, type, row){
					html = '<div class="btn-group"><a data-toggle="tooltip" data-placement="top" title="Editar Producto" class="btn btn-warning btn-flat" href="/adimel/producto/'+row['pro_codigo']+'/edit/"><i class="fas fa-edit"></i></i></a></div>';
					$('[data-toggle="tooltip"]').tooltip();
					return html;
				},
				"className": "text-center"
			}
			],
			"columnDefs": [
			{
				"targets": [ -1 ],
				"orderable": false,
			}
			],
			"createdRow": function ( row, data, index ) {

			},
			"paging": true,
			"info": true,
			"autoWidth": true,
			"bPaginate":true,
			"sPaginationType":"full_numbers",
			"bLengthChange": true,
			"bInfo" : true,
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
		})

		$('.dataTables_length').remove();
		$('.dataTables_filter').remove();

	});

		/*
		*	DATATABLE POR MEDIO DEL CLIENTE

		$(document).ready(function() {
			table = $('#user_table').DataTable();

			$('[data-toggle="tooltip"]').tooltip();


		});

		*/

		//USAR SELECT PROPIO PARA CANTIDAD DE REGISTROS
		$('#show_record').click(function() {
			table.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tabla_inc_info").text());
		});

		//USAR INPUT PROPIO PARA FILTRO
		$('#search_input').keyup(function(){
			table.search($(this).val()).draw() ;
		})

	</script>
	@endsection