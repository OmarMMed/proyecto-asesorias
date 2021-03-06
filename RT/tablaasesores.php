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
                               <a class="dropdown-item" href="../exit.php">Cerrar Sesi??n</a>

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
                    <div class="col-lg-10 mt-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Lista de Asesores</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID Asesor</th>
                                                    <th scope="col">Correo</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Password</th>
                                                    <th scope="col">Celular</th>
                                                    <th scope="col">Carrera</th>
													<th scope="col">Grupo</th>
                                                    <th scope="col">Dias Disponibles</th>
                                                    <th scope="col">Horario</th>

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
            <?php 
            
               $sql = "SELECT * FROM asesores";
               $resultado = mysqli_query($con,$sql);
               if (!empty($resultado) ) {
				  
                 while ($row = $resultado->fetch_assoc()) 
				 {
                   ?>
                  
                   
                   <tr>
                      <th><?php echo $row["idAsesor"] ?></th>
                      <th><?php echo $row["correo"]  ?></th>
                      <th><?php echo $row["nombre"]  ?></th>
					  <th><?php echo $row["password"]  ?></th>
                      <th><?php echo $row["celular"]  ?></th>
                      <th><?php echo $row["carrera"]  ?></th>
                      <th><?php echo $row["grupo"]  ?></th>
                      <th><?php echo $row["diasDisponibles"]  ?></th>
                      <th><?php echo $row["horario"]  ?></th>
                      <th><a href="delete.php?id=<?php echo $row["idAsesor"] ?>">Eliminar</a></th>
                      
                    </tr>
            <?php
                 
                 }
               }
 
            ?>
                                            </tbody>
                                        </table>
            
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
