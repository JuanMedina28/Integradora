<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home Party Service</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-dark bg-black fixed-top">
            <div class="container">
                <img class="logo-img col-2" style="float: right" src="/assets/img/LogoPartyServiceSFVertical.png">
                <div style="float: left">
                    <a class="btn btn-black text-cyan" href="{{ route('register') }}"><i class="bi-person-circle m-auto text-degradado"></i> Registrar</a>
                    <a class="btn btn-black text-rosita" href="{{ route('login') }}"><i class="bi-key-fill m-auto text-degradado"></i>Iniciar Sesion</a>
            
                </div>
            </div>
        </nav>        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <h1 class="mb-5">¡Encuentra los mejores servicios de entretenimiento!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-gris-oxford text-center text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-search m-auto text-degradado"></i></div>
                            <h3 class="text-cyan">Busca el servicio ideal</h3>
                            <p class="lead mb-0">Busca el servicio de tu agrado cerca de tu zona.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-chat-dots m-auto text-degradado"></i></div>
                            <h3 class="text-cyan">Chat de comunicaciones</h3>
                            <p class="lead mb-0">Crea una comunicación con el prestador de servicios.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-currency-exchange m-auto text-degradado"></i></div>
                            <h3 class="text-cyan">Paga con OpenPay</h3>
                            <p class="lead mb-0">Realiza tu pago de forma segura con OpenPay.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/App Movil MockUp.png')"></div>
                    <div class="col-lg-6 order-lg-1 showcase-text bg-black text-center text-white">
                        <h2 class="text-rosita">Desgarca la App Móvil</h2>
                        <p class="lead mb-0">
                            Descarga nuestra app móvil desde la play store o app store totalmente gratis, 
                            para tener tus servicios de entretenimiento a la mano.
                        </p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('assets/img/Sitio Web MockUp.png')"></div>
                    <div class="col-lg-6 showcase-text bg-gris-oxford text-center text-white">
                        <h2 class="text-cyan">Página Web Completamente Responsiva</h2>
                        <p class="lead mb-0">
                            Nuestra página web es completamente responsiva, se adapta a cualquier pantalla y dispositivo
                            para que puedas tener la mejor experiencia al navegar.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto ">
                        <!--<ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!" class="text-cyan">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-cyan">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-cyan">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!" class="text-cyan">Privacy Policy</a></li>
                        </ul>-->
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Derechos reservados a DPower S.A de C.V.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3 text-degradado""></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3 text-degradado"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3 text-degradado""></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>