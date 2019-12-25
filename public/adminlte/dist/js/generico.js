function blockUI(){
	$.blockUI({
		css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000','-webkit-border-radius': '10px','-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		},
		baseZ: 2000,
		message: '<h1><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Espere por favor...</h1>'
	});
};

function unblockUI(){
	$.unblockUI();
};

/*
function call_notify(titulo, mensaje, tipo, icon) {
	$.notify({
		icon: icon,
		title: "<strong>" + titulo + "</strong> <br/>",
		message: mensaje
	}, {
		type: tipo,
		showProgressbar: false,
		placement: {
			from: "bottom",
			align: "right"
		},
		delay: 4000,
		timer: 3000,
		z_index: 9999,
		animate: {
			enter: 'animated fadeInDown',
			exit: 'animated fadeOutUp'
		}
	});
}
*/