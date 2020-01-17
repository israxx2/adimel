<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Bienvenid@ {{ ucwords(strtolower(Auth::guard('funcionario')->user()->fun_nombre)) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('adminlte/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{ ucwords(strtolower(Auth::guard('funcionario')->user()->fun_nombre)) }}
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="float-right">
                        <a href="#" class="btn btn-default btn-flat" onclick="logout();">Salir</a>

                        <form id="logout-form" action="{{ route('funcionario.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </li>

    </ul>
    <script src="{{ asset('AdminLTE/dist/js/logout.js') }}" type="text/javascript" charset="utf-8" async defer></script>
</nav>