
    <ul class="minicart-product-list" id="minicart1">
        @foreach (Auth::guard('cliente')->user()->carrito as $p)
            <li id={{$p->prod_codigo}}>
                <a href="/viewProduct/{{$p->prod_codigo}}" class="minicart-product-image">
                    <img src="/imageProducts/{{$p->prod_codigo}}.png" alt="cart products">
                </a>
                <div class="minicart-product-details">
                    <h6><a href="/viewProduct/{{$p->prod_codigo}}">{{$p->prod_nombre}}</a></h6>
                    <span id="cantidad-`+index+`">${{$p->precio}} x {{$p->cantidad}}</span>
                </div>
                <button class="close" onclick="removeProducto({{$p->prod_codigo}})">
                    <i class="fa fa-close"></i>
                </button>
            </li>
        @endforeach
    </ul>
