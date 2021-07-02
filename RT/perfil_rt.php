<?php 
include("../header.php");
require '../conexion.php';
if(isset($_SESSION['asesor'])){
    header("Location: ../asesor/asesores.php");
  }

elseif(isset($_SESSION['estudiante'])){
  header("Location: ../estudiante/estudiantes.php");
}
  elseif(!isset($_SESSION['rt'])){
    header("Location: index.php");
  }
  else{
      $num = $_SESSION['rt'];

      $con = conectar();

    $query = "SELECT * FROM responsabletutorias WHERE numeroCuenta = '$num'";
    $result = $con->query($query);
    $row = $result->fetch_object();
    $nombre = $row->nombre;
  }
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
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/style.css">
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
                    <a href="https://fic.uas.edu.mx/departamento-de-tutorias/"><img src="../assets/images/icon/logo3.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="rt.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Inicio</span></a>
                                
                            </li>
                            
                           
                            
                            <li class="active">
                                <a href="tablaasesores.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Ver lista Asesores</span></a>                               
                            </li>
                            
                            <li class="active">
                                <a href="historial.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Ver Historias de asesorias</span></a>                               
                            </li>
                            <li class="active">
                                <a href="lista_estudiante.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Lista de Estudiantes inscritos a Tutorias</span></a>                               
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
                            <h4 class="page-title pull-left">Responsable de Tutorias</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="rt.php">Inicio</a></li>
                                <li><a href="tablaasesores.php"><span>Ver asesores</span></a></li>
                                <li><a href="historial.php"><span>Ver historial de asesorias</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Perfil -->
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                        <a href="perfil_rt.php"><img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar" url=></a>
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $nombre; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="perfil_rt.php">Ver perfil</a>
                               <a class="dropdown-item" href="../exit.php">Cerrar Sesión</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div>
            
     <h1 style="text-align:center">Responsable de tutorias</h1>
     
            <body>

            </body>
            <div class="main-content-inner">
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                <!-- DESDE AQUI EMPIEZAN A PEGAR -->
                <?php
                $num = $_SESSION['rt'];

                $con = conectar();

                    $query = "SELECT * FROM responsabletutorias WHERE numeroCuenta = '$num'";
                    $result = $con->query($query);
                    $row = $result->fetch_object();
                    $_numCuenta = $row->numeroCuenta;
                    $_pass = $row->password;
                    $_nombre = $row->nombre;
                    $_correo = $row->correo;
                    $_celular = $row->celular;
                    
                ?>

                        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Perfil RT</h2>
                        <form action="editar_perfil_rt.php" method="post">
                            <?php if(isset($_GET['error']))
                            { 
                                $error = $_GET['error'];
                                echo '<strong style="color: red">'. $error .'</strong><br>';
                            }
                            ?>
                            <labe>Numero de Cuenta:</label>
                            <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8" value="<?=$_numCuenta?>"  readonly=»readonly>
                            </p>
                            <labe>Nombre</label>
                            <input type="text" name="nombre" pattern="[A-Za-z áéíóúñ]*" maxlength="50" placeholder="Nombre completo" value="<?=$_nombre?>">
                            </p>
                            <labe>Correo Electronico</label>
                            <input type="email" name="correo" maxlength="40" placeholder="Correo Electronico" value=<?=$_correo?>>
                            </p>
                            <labe>Celular</label>
                            <input type="text" name="telefono" pattern="[0-9]*" minlength="10" maxlength="10" placeholder="Celular" value=<?=$_celular?>>
                            </p>
                            <input type="submit" class="btn btn-success" value="Guardar cambios" name="editar">
                        </form>

                        <form action="borrar_rt.php" method="POST" onsubmit="if(!confirm('Seguro que desea borrar?')){return false;}">
                            <input type="submit" class="btn btn-danger" value="borrar perfil" name="borrar">
                        </form><br>
                    </div><br>
                        <div class="signup-image">
                            <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                            <a href="" class="signup-image-link"></a>
                        </div>
                </div>
            </div>
        </section>


            <!-- AQUI TERMINAN DE PEGAR -->
                                    </div>
            
                                </div>
                                
                        <div>


</div>   
                    </div>



      
<html>
<head>
	<title>Add Item</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

</html>
    






    </div>
    
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
