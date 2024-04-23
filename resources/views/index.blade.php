<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NutriCoc</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('startbootstrap/assets/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="{{ asset('startbootstrap/css/bootstrap-icons.css') }}" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('startbootstrap/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('startbootstrap/css/bootstrap-icons.css') }}">
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="#!">HHH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('guardiaPedir') }}" target="_blank">Guardia</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('obstetriciaResetear') }}" target="_blank">Obstetricia</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Residentes</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Recargos</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Internados</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('loginUsuario') }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="py-5">
    <div class="container px-lg-5" >
        <div class="p-4 p-lg-5  rounded-3 text-center" style="background-image: url({{ asset('img/background.jpg') }}); height: 100%; width: 100%;" >
            <div class="m-4 m-lg-5">
                <h1 class="display-5 fw-bold text-white" style="visibility: hidden;">NutriCoc</h1>
                <p class="fs-4 text-white" style="visibility: hidden;">Sistema para gestión electrónica de Diestas, Recargos, Colaciones, etc.</p>

            </div>
        </div>
    </div>
</header>
<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-display"></i></div>
                        <h2 class="fs-4 fw-bold"><a style="text-decoration:none;" href="{{ route('monitorPedidos') }}" target="_blank">Monitor de Pedidos <h6>click aquí</h6></a></h2>
                        <p class="mb-0">Monitor de Pedidos de Dietas</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-hospital" style="font-size: 2rem;"></i></div>
                        <h2 class="fs-4 fw-bold"><a style="text-decoration:none;" href="{{ route('guardiaPedir') }}" target="_blank">Pacientes en Guardia <h6>click aquí</h6></a></h2>
                        <p class="mb-0">Dietas, Colaciones. Pedidos para pacientes internados en guardia</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-person-standing-dress"></i></div>
                        <h2 class="fs-4 fw-bold"><a style="text-decoration:none;" href="{{ route('obstetriciaResetear') }}" target="_blank">Pacientes Obstetricia <h6>click aquí</h6></a></h2>
                        <p class="mb-0">Dietas, Colaciones. Pedidos para Pacientes Obstetricas, preparto y monitoreo fetal</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-clipboard2-heart-fill"></i></div>
                        <h2 class="fs-4 fw-bold">Personal de Guardia y Recargo</h2>
                        <p class="mb-0"><strong><h2 class="text-danger">En Construcción</h2></strong></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-people-fill" style="font-size: 2rem;"></i></i></div>
                        <h2 class="fs-4 fw-bold">Residentes</h2>
                        <p class="mb-0"><strong><h2 class="text-danger">En Construcción</h2></strong></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-basket-fill"></i></div>
                        <h2 class="fs-4 fw-bold">Pacientes Internados</h2>
                        <p class="mb-0"><strong><h2 class="text-danger">En Construcción</h2></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Hospital Dr. Horacio Heller 2024</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{ asset('startbootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core theme JS-->
<script src="{{ asset('startbootstrap/js/scripts.js') }}"></script>
</body>
</html>
