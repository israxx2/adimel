<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark"><i class="{{ $header['icon'] }}"></i> {{ $header['title'] }}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					@foreach($pages as $page)
					@if($loop->last)
					<li class="breadcrumb-item active">{{ $page['title'] }}</li>
					@else
					<li class="breadcrumb-item"><a href="{{ $page['href'] }}">{{ $page['title'] }}</a></li>
					@endif
					@endforeach
					
					
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>