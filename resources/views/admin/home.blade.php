@extends('admin.template.app')

@section('title', 'Inicio')

@section('content')

<!-- Content Header (Page header) -->
@include('admin.template.componentes.content_header', [
'title' => 'Inicio',
'pages' => [
	['title' => 'Inicio']
]
])
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<!-- /.row -->
		<!-- Main row -->
		<div class="row">

		</div>
		<!-- /.row (main row) -->
	</div>
	<!-- /.container-fluid -->
</section>
            <!-- /.content -->

@endsection