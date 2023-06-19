<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
  header('Location: ../login.php');
}
//---Procedimiento para usuarios--------
include_once '../model/modelo_conexion.php';
$conexion = new conexionBD();
$pdo = $conexion->conexionPDO();

$sql ="select count(*) as total from usuario";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $resultado['total'];

//---Procedimiento para alumnos--------
$pro ="select count(*) as totalalum from alumno";
$pa = $pdo->prepare($pro);
$pa->execute();

$tit = $pa->fetch(PDO::FETCH_ASSOC);
$totalalum = $tit['totalalum'];

//---Procedimiento para apoderados--------
//Madre
$mt ="select count(*) as totalm from madre where madre_dni > 0";
$rm = $pdo->prepare($mt);
$rm->execute();

$tit = $rm->fetch(PDO::FETCH_ASSOC);
$totalm = $tit['totalm'];
//Padre
$pt ="select count(*) as totalp from padre where padre_dni > 0";
$rp = $pdo->prepare($pt);
$rp->execute();

$tit = $rp->fetch(PDO::FETCH_ASSOC);
$totalp = $tit['totalp'];

//Apoderado
$at ="select count(*) as totala from apoderado where apoder_dni > 0";
$ra = $pdo->prepare($at);
$ra->execute();

$tit = $ra->fetch(PDO::FETCH_ASSOC);
$totala = $tit['totala'];
//SUMA DE MADRE+PADRE+APODERADOS
$suma = $totalm+$totalp+$totala;

//---Procedimiento para matriculas--------
$matrict ="select count(*) as totalmatric from matricula where matric_estado='ACTIVO'";
$rmatric = $pdo->prepare($matrict);
$rmatric->execute();

$tit = $rmatric->fetch(PDO::FETCH_ASSOC);
$totalmatric = $tit['totalmatric'];

//---Procedimiento para pagos--------
$pagost ="select count(*) as totalpagos from pagos ";
$rpagos = $pdo->prepare($pagost);
$rpagos->execute();

$tit = $rpagos->fetch(PDO::FETCH_ASSOC);
$totalpagos = $tit['totalpagos'];

//---Procedimiento para solicitudes--------
$solit ="select count(*) as totalsoli from inscripcion";
$rsoli = $pdo->prepare($solit);
$rsoli->execute();

$tit = $rsoli->fetch(PDO::FETCH_ASSOC);
$totalsoli = $tit['totalsoli'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel Administrativo</title>

    <!-- Custom fonts for this template-->
    <link href="../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../Assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../Assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../plantilla/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css"
        href="../plantilla/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">

                </div>
                <div class="sidebar-brand-text mx-3">CEP VDC</div><img src="../Assets/img/vdclogo.png" width="50"
                    height="50">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-bars "></i>
                    <span>Panel Administrativo</span></a>
            </li>
            <?php if($_SESSION['S_ROL']=="1"){?>
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_usuario.php')">
                    <i class="fas fa-user fa-cog"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','alumno/mantenimiento_alumno.php')">
                    <i class="fas fa-user-graduate"></i>
                    <span>Alumnos</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','apoderado/mantenimiento_apoderado.php')">
                    <i class="fas fa-user-tie"></i>
                    <span>Padres-Apoderados</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','matricula/mantenimiento_matricula.php')">
                    <i class="fas fa-address-card"></i>
                    <span>Matrículas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','pagos/mantenimiento_pagos.php')">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Pagos Mensuales</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','inscripcion/mantenimiento_inscripcion.php')">
                    <i class="fas fa-comment"></i>
                    <span>Solicitudes</span>
                </a>
            </li>
            <?php }?>
            <?php if($_SESSION['S_ROL']=="2"){?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','alumno/mantenimiento_alumno.php')">
                    <i class="fas fa-user-graduate"></i>
                    <span>Alumnos</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','apoderado/mantenimiento_apoderado.php')">
                    <i class="fas fa-user-tie"></i>
                    <span>Padres-Apoderados</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','matricula/mantenimiento_matricula.php')">
                    <i class="fas fa-address-card"></i>
                    <span>Matrículas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','pagos/mantenimiento_pagos.php')">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Pagos Mensuales</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="cargar_contenido('contenido_principal','inscripcion/mantenimiento_inscripcion.php')">
                    <i class="fas fa-box"></i>
                    <span>Solicitudes</span>
                </a>
            </li>
            <?php }?>






        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['S_USUARIO']; ?></span>
                                <img class="img-profile rounded-circle" src="../Assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../controller/usuario/destruir_sesion.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="contenido_principal">



                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-10 col-md-9 mb-4">
                            <div class="card  shadow ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bienvenido al sistema, administrador!</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">SISTEMA DE GESTION PARA
                                                MATRICULAS Y PAGOS MENSUALES
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                USUARIOS REGISTRADOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                ALUMNOS REGISTRADOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalalum ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                PADRES-APODERADOS REGISTRADOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $suma ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                MATRÍCULAS ACTIVAS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalmatric ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                PAGOS REGISTRADOS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalpagos ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                SOLICITUDES PENDIENTES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalsoli ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comment fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CEP Virgen del Carmen 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../Assets/vendor/jquery/jquery.min.js"></script>
    <script src="../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../Assets/js/sweetalert2@11.js"></script>
    <script src="../Assets/js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../plantilla/plugins/select2/js/select2.full.js"></script>
    <script>
    function cargar_contenido(id, vista) {
        $("#" + id).load(vista);
    }

    var idioma_espanol = {
        select: {
            rows: "%d fila seleccionada"
        },
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
        "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
        "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "<b>No se encontraron datos</b>",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ultimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

    $(function() {
        var menues = $(".nav-link");
        menues.click(function() {
            menues.removeClass("active");
            $(this).addClass("active");
        });
    });

    function soloNumeros(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8) {
            return true;
        }
        // Patron de entrada, en este caso solo acepta numeros
        patron = /[0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }

    function filterFloat(evt, input) {
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempValue = input.value + chark;
        if (key >= 48 && key <= 57) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            if (key == 8 || key == 13 || key == 0) {
                return true;
            } else if (key == 46) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    function filter(__val__) {
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if (preg.test(__val__) === true) {
            return true;
        } else {
            return false;
        }
    }
    </script>



</body>

</html>