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
                <img src="{{ asset('Adminlte/dist/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2 alt="User Image">
                <span class="hidden-xs">{{ strtoupper(Auth::guard('funcionario')->user()->fun_nombre) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('Adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        Eduardo González - Informático
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="float-left">
                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="float-right">
                        <a href="#" class="btn btn-default btn-flat" onclick="logout();">Salir</a>

                        <form id="logout-form" action="#" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </li>

    </ul>
</nav>