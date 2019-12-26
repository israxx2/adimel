<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

let carrito = [];
let subtotal=0;
if(localStorage.getItem("carrito")!=null){
    carrito=localStorage.getItem("carrito");
    carrito=JSON.parse(carrito);
}

carrito.forEach(producto => {
    
    $(".minicart-product-list").append(`
        <li>
            <a href="single-product.html" class="minicart-product-image">
                <img src="{{ asset('electro/images/product/small-size/1.jpg') }}" alt="cart products">
            </a>
            <div class="minicart-product-details">
                <h6><a href="single-product.html">`+producto.nombre+`</a></h6>
                <span>$`+producto.precio+` x `+producto.cantidad+`</span>
            </div>
            <button class="close">
                <i class="fa fa-close"></i>
            </button>
        </li>
        `)
    subtotal= producto.precio*producto.cantidad + subtotal;
    });

    $("#subtotal1").text('$'+subtotal);
    $("#subtotal2").text('$'+subtotal);
    $("#cantidad").text(carrito.length);


export function Añadir(id,nombre,precio,cantidad){
    console.log(id,nombre,precio,cantidad)
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
    
}
