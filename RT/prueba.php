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
                    <div class="col-lg-10 mt-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Historial de Asesorias</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                    <div class="row col-12">
	<div  class="col-10"></div>
	<div class="search-box pull-left">
	<input type="text" id="myInput2" onkeyup="myFunction()" placeholder="Buscar asesor.." title="Escribe un nombre">
   </div>
</div>


<table class="table table-striped table-bordered" id="myTable">
<tr>
      <th>Clave</th>
      <th  onclick="sortTable(1)" style="cursor: pointer">Materia</th>
      <th onclick="sortTable(2)" style="cursor: pointer">Fecha y hora</th>
      <th onclick="sortTable(3)" style="cursor: pointer";>Nombre Estudiante</th>
      <th onclick="sortTable(4)" style="cursor: pointer">Nombre Asesor</th>
      <th onclick="sortTable(5)" style="cursor: pointer">Grupo</th>
      <th onclick="sortTable(6)" style="cursor: pointer">Carrera</th>
    </tr>
    <?php
    
    //Crear la conexion al servidorde base de datos
    $conn = new  mysqli($servidor,$usuario,$pwd,$bd);


    //verificar la conexion al servidor de base de datos
    if ($conn->connect_error) {
    	die("Error al momento de conectar al servidor : " . $conn->connect_error);
    }

   //obtener los registros de la base de datos 
    $sql = "SELECT *  from agenda";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
    	while ($row = $result->fetch_object()) {
    		
         echo "<tr>";
            echo "<td>" . $row->idAsesoria . "</td>";
            echo "<td>" . $row->nombreMateria . "</td>";
            echo "<td>" . $row->Fecha . "</td>";
            echo "<td>" . $row->nombreEstudiante . "</td>";
            echo "<td>" . $row->nombreAsesor . "</td>";
            echo "<td>" . $row->grupoEstudiante . "</td>";
            echo "<td>" . $row->carrera . "</td>";
         echo "</tr>";

    	}
    	$result->free();
    	
    }
    $conn-> close();

echo '
</table>




<script>


function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>';?>
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
