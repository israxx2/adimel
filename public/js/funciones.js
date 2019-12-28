ActualizarCarrito();

function Añadir(id,nombre,precio,cantidad){
  
    let carrito = [];

    if(localStorage.getItem("carrito")!=null){
        carrito=localStorage.getItem("carrito");
        carrito=JSON.parse(carrito);
    }
    
    let total= precio*cantidad;

   let product={
       id: id,
       nombre: nombre,
       precio: precio,
       cantidad: cantidad,
       total: total,
   }
    carrito.push(product)
    localStorage.setItem("carrito", JSON.stringify(carrito));

    addProducto(id,nombre,precio,cantidad);
    CalculateCarrito()

}

function addProducto(id,nombre,precio,cantidad){

    $(".minicart-product-list").append(`
    <li id="`+id+`">
        <a href="single-product.html" class="minicart-product-image">
            <img src="/imageProducts/`+id+`.png" alt="cart products">
        </a>
        <div class="minicart-product-details">
            <h6><a href="single-product.html">`+nombre+`</a></h6>
            <span>$`+precio+` x `+cantidad+`</span>
        </div>
        <button class="close" onclick="Eliminar('`+id+`')">
            <i class="fa fa-close"></i>
        </button>
    </li>
    `)

}

function CalculateCarrito(){
    let subtotal=0;
    let carrito = [];
	if(localStorage.getItem("carrito")!=null){
		carrito=localStorage.getItem("carrito");
		carrito=JSON.parse(carrito);
	}

	carrito.forEach(producto => {
		subtotal= producto.precio*producto.cantidad + subtotal;
	});

    $("#subtotal1").text('$'+subtotal);
    $("#subtotal2").text('$'+subtotal);
    $("#cantidad").text(carrito.length);
        
}


function ActualizarCarrito(){
    let subtotal=0;
    let carrito = [];
	if(localStorage.getItem("carrito")!=null){
		carrito=localStorage.getItem("carrito");
		carrito=JSON.parse(carrito);
	}

	carrito.forEach(producto => {
		$(".minicart-product-list").append(`
			<li id="`+producto.id+`">
				<a href="single-product.html" class="minicart-product-image">
					<img src="/imageProducts/`+producto.id+`.png" alt="cart products">
				</a>
				<div class="minicart-product-details">
					<h6><a href="single-product.html">`+producto.nombre+`</a></h6>
					<span>$`+producto.precio+` x `+producto.cantidad+`</span>
				</div>
				<button class="close" onclick="Eliminar('`+producto.id+`')">
					<i class="fa fa-close"></i>
				</button>
			</li>
			`)
		subtotal= producto.precio*producto.cantidad + subtotal;
		});

		$("#subtotal1").text('$'+subtotal);
		$("#subtotal2").text('$'+subtotal);
        $("#cantidad").text(carrito.length);
        
}


function Eliminar(id){
    let carrito = [];

    if(localStorage.getItem("carrito")!=null){
        carrito=localStorage.getItem("carrito");
        carrito=JSON.parse(carrito);
    }


    for (var i = 0; i < carrito.length; i++) {
        var product = carrito[i];
        if (product.id.toString() == id) {
            carrito.splice(i, 1);
        }
    }

     localStorage.setItem("carrito", JSON.stringify(carrito));
     $("#"+id).remove();
     CalculateCarrito();

 

}