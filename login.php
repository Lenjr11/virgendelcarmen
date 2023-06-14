<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) {
  header('location: view/index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iniciar Sesión</title>

    <!-- Custom fonts for this template-->
    <link href="Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="Assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="Assets/img/favicon.ico">

</head>

<body class="bg-gradient">


        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="card o-hidden border-0  my-5">
                    <!-- Nested Row within Card Body -->
                    <div class="login-box">
                        <div class="text-center my-3">
                            <img src="Assets/img/vdc2.jpg" width="200" height="180">
                            <h1 class="h4 text-gray-900 mb-4">INICIAR SESIÓN</h1>
                        </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txt_usuario" name="txt_usuario"
                                    placeholder="USERNAME">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="txt_pass" name="txt_pass"
                                    placeholder="CONTRASEÑA">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" onclick="Iniciar_Sesion()">
                                Ingresar
                            </button>
                            <div class="text-left">
                                <a class="small" href="forgot-password.html">Olvidaste tu contraseña?</a>
                            </div>
                    </div>
                </div>

            </div>

        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="Assets/vendor/jquery/jquery.min.js"></script>
    <script src="Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="Assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/usuario.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="Assets/js/sb-admin-2.min.js"></script>
    <script src="Assets/js/sweetalert2@11.js"></script>
    <script src="js/usuario.js?rev=<?php echo time(); ?>"></script>

</body>

</html>