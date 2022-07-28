<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('argon') }}/img/brand/white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->


            
            <!-- Navbar items -->


            
            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                        <i class="ni ni-circle-08 text-degradado"></i>
                        <span class="nav-link-inner--text text-cyan">{{ __('Registrar') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                        <i class="ni ni-key-25 text-degradado"></i>
                        <span class="nav-link-inner--text text-rosita">{{ __('Iniciar Sesion') }}</span>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>