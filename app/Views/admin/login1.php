<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->renderSection("page_title") ?></title>

    <!-- Custom fonts for this template-->
    <link href="assets/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagen/png" href="/assets/img/template/logo2.jpeg" />
    <link href="<?= base_url() ?>/assets/css/login.css" rel="stylesheet">

</head>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">BIENVENIDO</h1>

                                    </div>
        <?php if(session('msg')): ?>
        <h1 style="color: <?= session('msg.type') ?>;"> <?= session('msg.body') ?></h1>
        <?php endif ?>
                                    <form action="/signin" method="post" class="user">
                                        <div class="form-group">
                                        <label for="usuario">Usuario:</label>
                                        

                                            <input type="text" name="usuario" class="form-control form-control-user"
                                            id="usuario" value="<?= old('usuario') ?>" aria-describedby="emailHelp"
                                                placeholder="Ingresar Usuario...">
                                                 <p style="color: red; font-size:10px;" ><?= session('errors.usuario') ?></p>
                                        </div>
                                        <div class="form-group">
                                        <label for="pass">Contraseña:</label>

                                        <input type="password" name="pass" class="form-control form-control-user"
                                            id="pass" placeholder="Ingresar Contraseña">
                                            <p style="color: red; font-size:10px;"><?= session('errors.pass') ?></p>

                                        </div>
                                        
                                        <div class="form-group" >
                                         <input type="submit" class="btn btn-primary btn-user btn-block" id="pass" value="Ingresar">
                                      </div>
                                      <a type="button" href="<?= base_url().route_to('login.index') ?>" class=" btn btn-google btn-user btn-block" >Regresar</a>
     
                                        </a>
                                     
                                    </form>
                                 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


<!-- Bootstrap core JavaScript-->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="vendor/Sweetalert2/sweetalert2.js"></script>

<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    txt_usu.focus();
    </script>
</html>
