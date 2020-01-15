ActualizarCarrito();

function Añadir(id,nombre,precio,cantidad){
  
    let carrito = GetFromLocalStorage();
    let total= precio*cantidad;

    let product={
        index: carrito.length+1,
        id: id,
        nombre: nombre,
        precio: precio,
        cantidad: cantidad,
        total: total,
    }
    carrito.push(product)
    SetLocalStorage(carrito);

    addProducto(carrito.length,id,nombre,precio,cantidad);
    CalculateCarrito()

}

function addProducto(index,id,nombre,precio,cantidad){

    $(".minicart-product-list").append(`
    <li id="`+index+`">
        <a href="single-product.html" class="minicart-product-image">
            <img src="/imageProducts/`+id+`.png" alt="cart products">
        </a>
        <div class="minicart-product-details">
            <h6><a href="single-product.html">`+nombre+`</a></h6>
            <span id="cantidad-`+index+`">$`+precio+` x `+cantidad+`</span>
        </div>
        <button class="close" onclick="Eliminar('`+index+`')">
            <i class="fa fa-close"></i>
        </button>
    </li>
    `)

}

function CalculateCarrito(){
    let subtotal=0;
    let carrito = GetFromLocalStorage();

	carrito.forEach(producto => {
        subtotal= producto.precio*producto.cantidad + subtotal;
        $("#total5-"+producto.index).text('$'+producto.total); //total por producto
        $("#cantidad-"+producto.index).text('$'+ producto.precio +'x' +producto.cantidad); //cantidad para carrito cabecera
	});
    //totales para carrito de cabecera
    $("#subtotal1").text('$'+subtotal);
    $("#subtotal2").text('$'+subtotal);
    $("#cantidad").text(carrito.length);
    //totales para vista cart.
    $("#subtotal3").text('$'+subtotal);
    $("#total4").text('$'+subtotal);

    //totales para checkout
    $("#subtotalCheckOut").text('$'+subtotal);
    $("#totalCheckOut").text('$'+subtotal);

    
   
    
}

function ActualizarCarrito(){
    let subtotal=0;
    let carrito = GetFromLocalStorage();


	carrito.forEach(producto => {
        addProducto(producto.index,producto.id,producto.nombre,producto.precio,producto.cantidad)
    });
	CalculateCarrito();

        
}

function Eliminar(index){
    let carrito = GetFromLocalStorage();

    for (var i = 0; i < carrito.length; i++) {
        var product = carrito[i];
        if (product.index== index) {
            carrito.splice(i, 1);
        }
    }


    SetLocalStorage(carrito);
    $("#"+index).remove(); //se remueve del carrito header
    $("#tr-"+index).remove(); //se remueve de la vista carrito
    CalculateCarrito();

 

}

function GetFromLocalStorage(){

    let carrito = [];
    if(localStorage.getItem("carrito")!=null){
        carrito=localStorage.getItem("carrito");
        carrito=JSON.parse(carrito);
    }
    return carrito;
}

function SetLocalStorage(carrito){
    localStorage.setItem("carrito", JSON.stringify(carrito));
}
function changeCantidad(e,index){
    let newCantidad=e.firstElementChild.value;

    let carrito = GetFromLocalStorage();

    for (var i = 0; i < carrito.length; i++) {
        var product = carrito[i];
        if (product.index== index) {
            carrito[i].cantidad=newCantidad;
            carrito[i].total=newCantidad*carrito[i].precio;
        }
    }
    SetLocalStorage(carrito);
    CalculateCarrito();

   
}