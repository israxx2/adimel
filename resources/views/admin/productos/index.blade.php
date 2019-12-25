@extends('admin.template.app')

@section('title', 'Productos')

@section('content')

<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
'title' => 'Productos',
'pages' => [
	['title' => 'Inicio', 'href' => route('admin')],
	['title' => 'Productos']
]
])
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<!-- /.row -->
		<!-- Main row -->
		<div class="row" id="row_productos">

		</div>
		<!-- /.row (main row) -->
	</div>
	<!-- /.container-fluid -->
</section>
            <!-- /.content -->

@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection