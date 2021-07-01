<?php 
include("../header.php");
require '../conexion.php';
if(isset($_SESSION['estudiante'])){
    header("Location: ../estudiante/estudiantes.php");
  }
  elseif(isset($_SESSION['rt'])){
    header("Location: ../RT/login_rt.php");
  }
  //confirmar inicio de sesión del RT
  if(!isset($_SESSION['asesor'])){
    header("Location: ../index.php");
}
      $num = $_SESSION['asesor'];

      $con = conectar();

    $query = "SELECT * FROM asesores WHERE idAsesor = '$num'";
    $result = $con->query($query);
    $row = $result->fetch_object();
    $nombre = $row->nombre;
  
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Asesorias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="https://fic.uas.edu.mx/departamento-de-tutorias/"><img src="../assets/images/icon/asesorpar.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="asesores.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Inicio</span></a>
                                
                            </li>
                            
                           
                            
                            <li class="active">
                                <a href="asesores.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Asesores</span></a>                               
                            </li>
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->


        
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    
                    <!-- profile info & task notification-->
                    <div class="col-md-6 col-sm-4 clearfix">
                        
                    </div>
                </div>
            </div>
            
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Asesor</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="asesores.php">Inicio</a></li>
                                <li><span>Ver solicitudes</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--Perfil -->
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                        <a href="perfil_asesor.php"><img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar" url=></a>
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $nombre; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="perfil_asesor.php">Ver perfil</a>
                               <a class="dropdown-item" href="../exit.php">Cerrar Sesión</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div>
            
     <h1 style="text-align:center">Asesor</h1>
     
            <body>

            </body>
            <div class="main-content-inner">
                <div class="row">