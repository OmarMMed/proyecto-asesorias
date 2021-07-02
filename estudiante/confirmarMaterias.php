<?php 
    require_once("../conexion.php");
    session_start();
    $con = conectar(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Solicitud de Asesoría</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
                            <h3>"Nuestra mayor debilidad reside en rendirnos. La forma más segura de tener éxito es intentarlo una vez más."</h3>
                            <span class="subheading">Thomas A. Edison</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">

        <footer class="border-top">
        <div class="contenedor">
        <?php if (empty($_POST["horaMin"]) && empty($_POST['horaMax']) 
        && empty($_POST['idAsesor']) || isset($_GET['error'])) : ?>
        <form method="POST" action="confirmarMaterias.php">

            <h2>Confirme el horario en que puede tomar asesorías</h2>
            <?php 
            if(isset($_GET['error']))
            {
                $error = $_GET['error'];
                echo '<strong style="color: red">'. $error .'</strong><br>';
            }
            ?>
            <label>De las horas:</label>
            <input type="time" name="horaMin" min="08:00" max="18:00">
            </p>
            <label>Hasta las horas: </label>  
            <input type="time" name="horaMax" min="09:00" max="19:00">
            <input type="submit" value="Confirmar">
        </form>
        <?php elseif(!empty($_POST["horaMin"]) && !empty($_POST['horaMax']) && empty($_POST['asesorNo'])): ?>
            <?php 
                $horaMin = $_POST['horaMin'];
                $horaMax = $_POST['horaMax'];
                if($horaMin > $horaMax)
                {
                    $error = "La hora miníma es mayor a la máxima.";
                    header("Location:confirmarMaterias.php?error=$error");
                }
                else
                {
                    echo "<h2>Asesores disponibles:</h2>";
                    $materias = $_SESSION['materia'];
                    $query = "SELECT * FROM asesores 
                                INNER JOIN materiasimpartidas AS mat_imp
                                ON asesores.idAsesor = mat_imp.idAsesor
                                INNER JOIN materias 
                                ON mat_imp.idMateria = materias.idMateria
                                WHERE (asesores.horario BETWEEN '$horaMin' AND '$horaMax')
                                AND (mat_imp.disponibilidad = 'S')
                                AND (materias.nombreMateria LIKE '%$materias%')";

                    if($result = mysqli_query($con,$query))
                    {
                        $idAsesorPrevio = "";
                        echo "<div class='single-table'>
                        <div class='table-responsive'>
                            <table class='table text-dark text-center'>
                                <thead class='text-uppercase'>
                                    <tr class='table-active'>
                            <tr><th>Nombre Asesorado</th>
                            <th>Dias Disponibles</th>
                            <th>Grado y Grupo del Asesor</th>
                            <th>Estado</th>
                            
                            </tr>
                            </thead>
                            <tbody";
                        if(mysqli_num_rows($result) > 0){
                                    while($rows = mysqli_fetch_assoc($result))
                                    {
                                        if($idAsesorPrevio != $rows['idAsesor'])
                                        {
                                            $idAsesor = $rows['idAsesor'];
                                            echo "<tr>";
                                            echo "<td>" .$rows['nombre'] . "</td>";
                                            echo "<td>" .$rows['diasDisponibles'] . "</td>";
                                            echo "<td>" .$rows['grado'] . "-". $rows['grupo'] . "</td>";
                                            echo "<form class='devoid' method='POST' action='confirmarMaterias.php'>";
                                            echo "<input type='hidden' name='idAsesor' value=$idAsesor>";
                                            echo "<td><input type='submit' value='Seleccionar Asesor'</td>";
                                            echo "</form>" ;
                                            echo "</tr>";
                                        }
                                        $idAsesorPrevio = $rows['idAsesor'];
                                    }
                    
                                        echo "</table>";
                                }else{
                                    echo "<h4>Por el momento no tenemos asesores disponibles!</h4>";
                                    echo "<h3>Vuelva a consultar con nosotros en los próximos días, siempre estamos consiguiendo asesores nuevos</h3>";
                                }
                    }
                    else
                    {
                        echo "<h2>Por el momento no tenemos asesores disponibles!</h2>";
                        echo "<h3>Vuelva a consultar con nosotros en los próximos días, siempre estamos consiguiendo asesores nuevos</h3>";
                    }
                }
            ?>
        <?php else : ?>
        <h2>Su solicitud de asesoría se ha enviado</h2>
        <h3>En breve se regresará a la página inicial</h3>
        <?php
            $idMateria = $_SESSION['idMateria'];
            $idAsesor = $_POST['idAsesor'];
            $numCuenta = $_SESSION['numCuenta'];
            $sqlSolicitud = "INSERT INTO solicitud(id_asesor,id_materia,id_estudiante,estado)
                            VALUES ($idAsesor,$idMateria,'$numCuenta','Pendiente')";
            $resultado = mysqli_query($con,$sqlSolicitud);
            header( "refresh:5;url=estudiantes.php" );  
        ?>
        <?php endif; ?> 
        </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
