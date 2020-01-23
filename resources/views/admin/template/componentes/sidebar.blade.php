<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/user.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">ADMINISTRACIÓN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              
                <li class="nav-item">
                    <a href="{{ route('admin.productos.index') }}" class="nav-link">                        
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ofertas.index') }}" class="nav-link">                        
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Ofertas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mercado.index') }}" class="nav-link">                        
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Mercado Público
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.configuracion.index') }}" class="nav-link">                        
                        <i class="nav-icon fa fa-fw fa-cog"></i>
                        <p>
                            Configuración
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>