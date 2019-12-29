@if($resourceScript == 'general')
<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- blockUI -->
<script src="{{ asset('adminlte/dist/js/jquery.blockUI.js') }}"></script>
<!-- funciones genericas -->
<script src="{{ asset('adminlte/dist/js/generico.js') }}"></script>
<<<<<<< HEAD
<script>
	function unblockUI(){
		$.unblockUI();
	};
	$(document).ajaxStart(function() {
		blockUI();
	}).ajaxStop(function() {
		unblockUI();
	});
</script>
@endif


@if($resourceScript == 'imagen')
<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Cropper JS -->
<script src="{{ asset('adminlte/plugins/cropperjs/dist/cropper.js') }}"></script>
<!-- JQuery Cropper JS Plugin -->
<script src="{{ asset('adminlte/plugins/jquery-cropper/dist/jquery-cropper.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- blockUI -->
<script src="{{ asset('adminlte/dist/js/jquery.blockUI.js') }}"></script>
<!-- funciones genericas -->
<script src="{{ asset('adminlte/dist/js/generico.js') }}"></script>
=======
>>>>>>> 53d84196d331c86d34133ecd35333ef698190961
<script>
	function unblockUI(){
		$.unblockUI();
	};
	$(document).ajaxStart(function() {
		blockUI();
	}).ajaxStop(function() {
		unblockUI();
	});
</script>
@endif