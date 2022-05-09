<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="assets/css/style3.css" rel="stylesheet">

    
    <title>SISGEM GAD DE JARAMIJO</title>
</head>

<body data-spy="scroll" data-target="menu">
    <!-- ? NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="menu">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><img src="assets/img/logo2.jpeg"  alt="Logo"></a>
            <a href="#" class="navbar-brand">Sistema informatico del GAD DE JARAMIJO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarMain">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a href="<?= base_url().route_to('login.index') ?>" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url().route_to('login1.index') ?>" class="nav-link">Ingresar</a>
                    </li>
                
                </ul>
            </div>
        </div>

    </nav>
    <!-- ? HEADER / HERO -->
    <header class="hero text-white" id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-5 d-none d-md-block">
                    <img src="assets/img/header-hero/computer.png" alt="hero mobile"
                        class="mobile-image animate__animated animate__fadeInUp animate__slower">
                </div>
                <div class="col-12 col-md-7">
                    <h1 class="mb-5 animate__animated animate__fadeInUp animate__slow">Sistema de registro y control de servicios de mantenimientos de equipos informaticos del GAD DE JARAMIJO</h1>
                    <p class="mb-5 animate__animated animate__fadeInUp animate__slow">Gobierno Autónomo Descentralizado Municipal del Cantón Jaramijó</p>
                </div>
            </div>
        </div>
    </header>
    <!-- ? SOBRE NOSOTROS -->
    <section id="sobre-nosotros">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <img src="assets/img/template/logo2.ico" alt="Logo">
                        <h5 class="text-muted mt-2 mb-4 wow animate__animated animate__headShake" data-wow-delay="1s">
                            SISTEMA WEB INFORMATICO</h5>
                        <h3 class="text-info mb-5 wow animate__animated animate__headShake" data-wow-delay="1s">Permite el regitro y control de servicios de mantenimiento de equipos informatico existente de la Institución del GAD DE JARAMIJO</h3>
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
   
  
    <!-- ? FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-box text-center">
                        <div class="rrss-box">
                            <a href="#" class="rrss-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="rrss-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="rrss-icon"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="rrss-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                        <p class="copy">
                            Copyright &copy; 2022 |
                            <a href="#" class="copy-link">@Sistema Web</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="  https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            }
        })
        // WOW
        new WOW().init()
    </script>
</body>

</html>