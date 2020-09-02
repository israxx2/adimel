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

<!-- Toastr JS -->
<script src="{{ asset('electro/js/toastr.min.js') }}"></script>

<script src="{{ asset('js/dropzone.js') }}"></script>
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