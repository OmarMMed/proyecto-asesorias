
<?php 
    include("../header.php");
    require '../conexion.php';
    if(isset($_SESSION['asesor'])){
        header("Location: ../asesor/asesores.php");
      }
      elseif(isset($_SESSION['rt'])){
        header("Location: ../rt/rt.php");
      }
      elseif(!isset($_SESSION['estudiante'])){
        header("Location: ../index.php");
      }
      else{
          $num = $_SESSION['estudiante'];
    
          $con = conectar();
    
        $query = "SELECT * FROM estudiante WHERE numCuenta = '$num'";
        $result = $con->query($query);
        $row = $result->fetch_object();
        $nombre = $row->nombreCompleto;
      }
    $numCuenta = $_SESSION['estudiante'];
    $queryAlumno = "SELECT * FROM estudiante 
                    WHERE numCuenta = '$numCuenta' LIMIT 1";
    if($datosAlumno = mysqli_query($con,$queryAlumno))
    {
        while($filaAlumno = mysqli_fetch_array($datosAlumno))
        {
            $nombre = $filaAlumno['nombreCompleto'];
            $grado = $filaAlumno['grado'];
            $carrera = $filaAlumno['carrera'];
        }
    }
?>
<!doctype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Solicitud de Asesoría</title>
        <link rel="stylesheet" href="../estilos.css">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
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
                                <a href="estudiantes.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Inicio</span></a>
                                
                            </li>
                            
                           
                            
                            <li class="active">
                                <a href="solicitud.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Solicitar una asesoria</span></a>                               
                            </li>
                            
                            <li class="active">
                                <a href="revisarSolicitud.php" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Mis asesorias</span></a>                               
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
                            <h4 class="page-title pull-left">Estudiante</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="estudiantes.php">Inicio</a></li>
                                <li><a href="solicitud.php">Solicitar una asesoria</a></li>
                                <li><a href="revisarSolicitud.php">Mis asesorias</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Perfil -->
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                        <a href="perfil_estudiante.php"><img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar" url=></a>
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $nombre; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="perfil_estudiante.php">Ver perfil</a>
                               <a class="dropdown-item" href="../exit.php">Cerrar Sesión</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div>
            
     <h1 style="text-align:center">Estudiante</h1>
     
            <body>

            </body>
            <div class="main-content-inner">
                <div class="row">

    <div class="contenedor">
            <?php if(empty($_POST['grado']) && empty($_POST['materia']) || isset($_GET['error'])) : ?>
            <h2>Selecciona el semestre del que desea tomar asesorías</h2>
            <?php
                if(isset($_GET['error']))
                {
                    $error = $_GET['error'];
                    echo '<strong style="color: red">'. $error .'</strong></p>';
                }
            ?>
                <form action="solicitud.php" method="POST">
                    <select name="grado">
                        <?php
                            for($i=1;$i<=$grado;++$i)
                            {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                <input type="submit" value="Elegir grado">
                </form>
            <?php endif; ?>
            <?php if (isset($_POST['grado']) && empty($_POST['materia'])) : ?>      
            <form action="solicitud.php" method="post">
                <h2><?php echo $nombre;?></h2>
                <h3>Materias que puede elegir para tomar asesorías:</h3>
                <?php
                    if(isset($_GET['error']))
                    {
                        $error = $_GET['error'];
                        echo '<strong style="color: red">'. $error .'</strong><br>';
                    }
                    $seleccion = $_POST['grado'];
                    if($seleccion == 1):
                ?> 
                <strong>Primer Año</strong><br>
                <select  name="materia" id="first" >
                <?php
                //Manda a llamar una función que llena el select
                //Esto se repite 5 veces. 1 Por cada año de la carrera.
                $select1 = "SELECT * FROM materias
                WHERE (semestre >= 1 AND semestre <= 2)";
                if($carrera != "ITSE")
                {
                    $select1 .= " AND categorias != 'ITSE'";
                }
                else
                {
                    $select1 .= " AND categorias = 'ITSE'";
                }
                if($result1 = mysqli_query($con,$select1))
                {
                    while($rows = mysqli_fetch_assoc($result1))
                    {
                        echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                    }
                }
                ?>
                    </select>
                    </p>
                    <?php endif; if ($seleccion == 2) : ?>
                            <strong>Segundo Año</strong><br>
                        <select name="materia" >
                            <?php
                            $select2 = "SELECT * FROM materias WHERE 
                            (semestre >= 3 AND semestre <= 4)";
                            if($carrera != "ITSE")
                            {
                                $select2 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select2 .= " AND categorias = 'ITSE'";
                            }
                            $result2 = mysqli_query($con,$select2);

                            if($result2)
                            {
                                while($rows = mysqli_fetch_assoc($result2))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    </p>
                    <?php endif; if($seleccion == 3) : ?>
                    <strong>Tercer Año</strong><br>
                    <select name="materia">
                        <?php
                            $select3 = "SELECT * FROM materias WHERE 
                            (semestre >= 5 AND semestre <= 6)";
                            if($carrera != "ITSE")
                            {
                                $select3 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select3 .= " AND categorias = 'ITSE'";
                            }
                            $result3 = mysqli_query($con,$select3);

                            if($result3)
                            {
                                while($rows = mysqli_fetch_assoc($result3))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    </p>
                    <?php endif; if($seleccion == 4) : ?>
                    <strong>Cuarto Año</strong><br>
                    <select name="materia">
                        <?php
                            $select4 = "SELECT * FROM materias WHERE 
                            semestre >= 7 AND semestre <= 8";
                            if($carrera != "ITSE")
                            {
                                $select4 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select4 .= " AND categorias = 'ITSE'";
                            }
                            $result4 = mysqli_query($con,$select4);

                            if($result4)
                            {
                                while($rows = mysqli_fetch_assoc($result4))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php endif; if($seleccion == 5) : ?>
                    <strong>Quinto Año</strong><br>
                    <select name="materia">
                        <?php
                            $select5 = "SELECT * FROM materias WHERE 
                            semestre >= 9";
                            if($carrera != "ITSE")
                            {
                                $select5 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select5 .= " AND categorias = 'ITSE'";
                            }
                            $result5 = mysqli_query($con,$select5);

                            if($result5)
                            {
                                while($rows = mysqli_fetch_assoc($result5))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php endif; ?>
                    </p>
                    <input type="submit" value="Elegir materias">
                    </form>
                <?php endif; ?>  
                <?php
                //Si no se selecciona una materia, manda un error a la página anterior.
                if( !empty($_POST['materia']))
                {
                    $nombreMateria = $_POST['materia'];
                    $idMateria = 0;
                    $queryMateria = "SELECT idMateria FROM materias
                    WHERE nombreMateria = '$nombreMateria' LIMIT 1";
                    if ($datosMateria = mysqli_query($con,$queryMateria))
                    {
                        while($filaMateria = mysqli_fetch_assoc($datosMateria))
                        {
                            $idMateria = $filaMateria['idMateria'];
                        }
                    }
                    $yaRegistrado = "SELECT count(*) as ya_registrado FROM solicitud AS s
                                    INNER JOIN materias AS m
                                    ON m.idMateria = s.id_materia
                                    INNER JOIN estudiante AS e
                                    ON e.numCuenta = s.id_estudiante
                                    WHERE m.idMateria = $idMateria
                                    AND e.numCuenta = '$numCuenta'
                                    AND s.estado = 'Pendiente'";
                    if($result = mysqli_query($con,$yaRegistrado))
                    {
                        $info = mysqli_fetch_assoc($result);
                        if($info['ya_registrado'])
                        {
                            $error = "Usted ya ha aplicado para asesoría en esa materia";
                            echo '<script type="text/javascript">alert("Ya solicito esta materia");</script>';
                            echo '<meta http-equiv="refresh" content="0;url="solicitud.php?error=$error';
                            //header("Location:solicitud.php?error=$error");
                        }
                        else
                        {
                            $_SESSION['idMateria'] = $idMateria;
                            echo "<h2> Confirmar Materia </h2>";
                            echo "<form action='confirmarMaterias.php' method='POST'>";
                            $i = 0;
                            $cadena = "<b>Materia para asesoría:</b> <ul><li>" . $_POST['materia'] ."</li></ul>";
                            echo $cadena;
                            $_SESSION['materia'] = $_POST['materia'];
                            echo "</p>";
                            echo "<input type='submit' value='Confirmar'>";
                            echo "</form>";
                        }
                    }
                }
                ?>
        </div>
    </body>


<?php include("footer_estudiante.php"); ?>