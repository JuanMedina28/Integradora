<nav class="shadow-lg mr-5 navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-black " id="sidenav-main">
    <div class="container-fluid ">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-2" href="{{ route('inicio') }}">
            <img src="{{ asset('argon') }}/img/brand/white.png" class="navbar-brand-img" style="width: 15rem;" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mi perfil') }}</span>
                    </a>
                    <!--<a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Configuración') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Actividad') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Soporte') }}</span>
                    </a>-->
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power"></i>
                        <span>{{ __('Salir') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inicio') }}">
                    <i class="ni ni-compass-04 text-degradado"></i>
                    <h3><span class="nav-link-text text-cyan">Inicio</span></h3>
                    </a>
                </li>

                @if(Auth::user()->can('mostrarAdminUser'))
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{ route('table') }}">
                      <i class="ni ni-bullet-list-67 text-degradado"></i>
                      <h3><span class="nav-link-text text-cyan">Tablas</span></h3>
                    </a>
                </li>-->
                @endif
               @if(Auth::user()->can('mostrarAdmin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crud_negocios') }}">
                    <i class="ni ni-shop text-degradado"></i>
                    <h3><span class="nav-link-text text-cyan">Negocios</span></h3>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can('mostarAdmin&Negocio'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crud_servicios') }}">
                        <i class="ni ni-basket text-degradado"></i>
                        <h3><span class="nav-link-text text-cyan">Servicios</span></h3>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can('mostrarAdmin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crud_clientes') }}">
                        <i class="ni ni-credit-card text-degradado"></i>
                        <h3><span class="nav-link-text text-cyan">Clientes</span></h3>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can('mostrarAdminUser'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crud_usuarios') }}">
                        <i class="ni ni-circle-08 text-degradado"></i>
                        <h3><span class="nav-link-text text-cyan">Usuarios</span></h3>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can('mostarCliente'))<!-- FALTA MODIFICAR LA VALIDACION -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carrito') }}">
                        <i class="ni ni-cart text-degradado"></i>
                        <h3><span class="nav-link-text text-cyan">Carrito</span></h3>
                    </a>
                </li>
                @endif
                
                @if(Auth::user()->can('mostarAdmin&Negocio'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pedidos')}}">
                        <i class="ni ni-bag-17 text-degradado"></i>
                        <h3><span class="nav-link-text text-cyan">Pedidos</span></h3>
                    </a>
                </li>
                @endif
                <!--<li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li>-->
                

            @if(Auth::user()->can('mostrarAdminUser'))
            <!-- 
            <hr class="my-3">
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> -->
            @endif
        </div>
    </div>
</nav>
