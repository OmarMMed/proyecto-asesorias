<!DOCTYPE html>
<?php 
    session_start();
    require_once("../conexion.php");
    $con = conectar();
    $numCuenta = $_SESSION['estudiante'];
    $_SESSION['numCuenta'] = $numCuenta;
    $queryAlumno = "SELECT * FROM estudiante 
                    WHERE numCuenta = '$numCuenta' LIMIT 1";
    $nombre = '';
    $grado = 0;
    $carrera = '';
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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Solicitar asesorias</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/sty.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="https://fic.uas.edu.mx/departamento-de-tutorias/">Departamento de tutorías</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="estudiantes.php">Regresar a Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="solicitud.php">Solicitar una asesoria</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="revisarSolicitud.php">Ver mis solicitudes</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h2>"Todos nuestros sueños se pueden volver realidad si tenemos el coraje de perseguirlos."</h2>
                            <span class="subheading">Walt Disney</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">

        <!-- Footer-->
        <footer class="border-top">
        <div class="contenedor">
            <?php if(empty($_POST['grado']) && empty($_POST['materia']) || isset($_GET['error'])) : ?>
            <h2>Selecciona el año del que desea tomar asesorías</h2>
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
                    </select><br>
            <div><br>
            <input type="submit" value="Elegir grado">
                        </dvi>
                
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
                            header("Location:solicitud.php?error=$error");
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
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
