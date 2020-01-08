<script>
	//NOTIFICACION: SUCCESS
	@if(Session::has('success'))
	$.notify({
		title: '<i class="fa fa-check"></i><strong> Éxito</strong><br/>',
		message: "{{ Session::get('success') }}",
	},{
		z_index: 3000,
		type: 'success',
		animate: {
			enter: 'animated fadeInUp',
			exit: 'animated fadeOutRight'
		},
		placement: {
			from: "bottom",
			align: "right"
		},
	});
	@php
	Session::forget('success');
	@endphp
	@endif

	//NOTIFICACION: ERROR
	@if(Session::has('error'))
	$.notify({
		title: '<i class="fa fa-fw fa-exclamation"></i><strong> Error</strong><br/>',
		message: "{{ Session::get('error') }}",
	},{
		z_index: 3000,
		type: 'danger',
		animate: {
			enter: 'animated fadeInUp',
			exit: 'animated fadeOutRight'
		},
		placement: {
			from: "bottom",
			align: "right"
		},
	});
	@php
	Session::forget('error');
	@endphp
	@endif

	
</script>



