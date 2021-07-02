<?php
    session_start();
    require_once("../conexion.php");
    $con = conectar();
    $esEstutudiante = "";
    if(!empty($_SESSION['estudiante'])){
        $esEstutudiante = TRUE;
        $numCuenta = $_SESSION['estudiante'];
    }elseif(!empty($_SESSION['asesor'])){
        $esEstutudiante = FALSE;
        $id = $_SESSION['asesor'];
    }else{
        header("Location: ../index.php");
    }
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
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="asesores.php">Regresar a Home</a></li>
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
                            <h3>“Aquellos que son más felices son los que hacen más por otros.</h3>
                            <span class="subheading">Booker T. Washington</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
        <div class="contenedor">
            <?php 
            if(!$esEstutudiante)
            {
                if(empty($_GET['sol']))
                {
                    
                    echo "<form method='POST' action='revisarSolicitud.php'>
                    <label for=''>Cambiar tipo de solicitudes</label>
                    <select name='estado'>
                    <option selected disabled hidden value=''>Elija el tipo de solicitud que desea revisar</option> 
                        <option value='Pendiente'>Solicitudes Pendientes</option>
                        <option value='Aceptado'>Solicitudes Aceptadas</option>
                        <option value='Rechazado'>Solicitudes Rechazadas</option>
                        <option value='Cancelado'>Solicitudes Canceladas</option>
                    </select>
                    <input type='submit' class='btn btn-dark' value='Cambiar'>
                    </form>";
                    $estado = "";
                    $heather = "";
                    if(empty($_POST['estado'])) 
                    {
                        $estado = "Pendiente";
                    }
                    else $estado = $_POST['estado'];
                    switch($estado)
                    {
                        case "Pendiente":
                            $heather = "pendientes";
                            $mensajeSino = "<h3>Usted no tiene solicitudes pendientes</h3>";
                            $aceptada = "Aceptada";
                            $rechazada = "Rechazada";
                            break;
                        case "Aceptado":
                            $heather = "aceptadas";
                            $cancelada = "Cancelado";
                            $mensajeSino = "<h3>Usted no ha aceptado ninguna solicitud aún</h3>";
                            break;
                        case "Rechazado":
                            $heather = "rechazadas";
                            $mensajeSino = "<h3>Usted no ha rechazado ninguna solicitud</h3>";
                            break;
                        case "Cancelado":
                            $heather = "canceladas";
                            $mensajeSino = "<h3>Usted no ha cancelado ninguna solicitud</h3>";
                            break;
                    }
                    $querySelect = "SELECT s.id_solicitud AS idSol,m.nombreMateria AS nombreMat,
                                    e.nombreCompleto AS nombreE,
                                    e.grado AS gradito,
                                    e.grupo AS grupito,
                                    s.estado AS estado
                                    FROM solicitud AS s
                                    INNER JOIN asesores AS a
                                    ON s.id_asesor = a.idAsesor
                                    INNER JOIN materias AS m
                                    ON m.idMateria = s.id_materia
                                    INNER JOIN estudiante AS e
                                    on s.id_estudiante = e.numCuenta
                                    WHERE s.estado = '$estado'
                                    AND s.id_asesor = $id";
                    echo "<h2>Solicitudes $heather</h2>";
                    if($result = mysqli_query($con,$querySelect))
                    {
                        if(mysqli_num_rows($result) > 0)
                        {
                            echo "<div class='single-table'>
                            <div class='table-responsive'>
                                <table class='table text-dark text-center'>
                                    <thead class='text-uppercase'>
                                        <tr class='table-active'>
                                <tr><th>Nombre Asesorado</th>
                                <th>Materia que solicita</th>
                                <th>Grado y Grupo del Asesorado</th>
                                <th>Estado</th>
                                
                                </tr>
                                </thead>
                                <tbody>";
                             
                            
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                $msg = "";
                                $idSolicitud = $rows['idSol'];
                                echo "<tr>";
                                echo "<th>" . $rows['nombreE'] . "</th>";
                                echo "<th>" . $rows['nombreMat'] . "</th>";
                                echo "<th>" . $rows['gradito'] . "-" . $rows['grupito'] . "</th>";
                                echo "<th>" . $rows['estado'] . "</th>";
                                if($estado == "Pendiente")
                                {
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$aceptada&idSol=$idSolicitud' onclick='if(!confirm(\"¿Seguro que desea aceptar la solicitud?\")){return false;}'>Aceptar</a></button></td>";
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$rechazada&idSol=$idSolicitud' onclick='if(!confirm(\"¿Seguro que desea rechazar la solicitud?\")){return false;}'>Rechazar</a></button></td>";
                                }
                                else if($estado == "Aceptado")
                                {
                                    echo "<th><button><a href='revisarSolicitud.php?sol=$cancelada&idSol=$idSolicitud' onclick='if(!confirm(\"¿Seguro que desea cancelar la solicitud?\")){return false;}'>Cancelar</a></buton></th>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        else
                        {
                            echo $mensajeSino;
                        }   
                    }
                    else
                    {
                        echo "Error al conectarse a la base de datos, valió gaver";
                    }
                }
                else
                {
                    $idSolicitud = $_GET['idSol'];
                    if($_GET['sol'] == "Aceptada")
                    {
                        $sqlActualizarSol = "UPDATE solicitud
                                            SET estado = 'Aceptado'
                                            WHERE id_solicitud = $idSolicitud";
                        if($result = mysqli_query($con,$sqlActualizarSol))
                        {
                            $datos = "SELECT m.nombreMateria AS nombreMat,
                            a.nombre AS nombreA,
                            e.nombreCompleto AS nombreE,
                            a.horario AS horario,
                            e.grado AS gradito,
                            e.grupo AS grupito,
                            e.carrera as carrera
                            FROM solicitud AS s
                            INNER JOIN asesores AS a
                            ON s.id_asesor = a.idAsesor
                            INNER JOIN materias AS m
                            ON m.idMateria = s.id_materia
                            INNER JOIN estudiante AS e
                            on s.id_estudiante = e.numCuenta
                            WHERE s.id_solicitud = $idSolicitud";
                            
                            if($result = mysqli_query($con,$datos))
                            {
                                while($rows = mysqli_fetch_assoc($result))
                                {
                                    $nombreMat = $rows['nombreMat'];
                                    $fecha = date('Y/m/d h:i:s', time());
                                    $nombreAsesor = $rows['nombreA'];
                                    $nombreEstudiante = $rows['nombreE'];
                                    $grupoEstudiante = $rows['gradito'] . '-' .$rows['grupito'];
                                    $carrera = $rows['carrera'];
                                    echo "<h2>Se ha aceptado la solicitud!</h2>";
                                    $sqlAgendar = "INSERT INTO agenda (nombreMateria,Fecha,nombreEstudiante,nombreAsesor,grupoEstudiante,carrera,id_sol)
                                                VALUES ('$nombreMat','$fecha','$nombreEstudiante','$nombreAsesor','$grupoEstudiante','$carrera','$idSolicitud')";
                                    if($result2 = mysqli_query($con,$sqlAgendar))
                                    {
                                        "<h2>Se ha aceptado su solicitud correctamente</h2>";
                                        header( "refresh:2;url=revisarSolicitud.php");
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        $estado = "Rechazado";
                        if($_GET['sol'] == "Cancelado") $estado = "Cancelado";
                        echo "<h2>Se ha $estado la solicitud!</h2>";
                        $sqlActualizarSol = "UPDATE solicitud
                                            SET estado = '$estado'
                                            WHERE id_solicitud = $idSolicitud";
                        if($result2 = mysqli_query($con,$sqlActualizarSol))
                        {
                            if($estado == "Cancelado")
                            {
                                $sqlBorrarAgenda = "DELETE FROM Agenda
                                                    WHERE id_sol = $idSolicitud";
                                $resultBorrar = mysqli_query($con,$sqlBorrarAgenda);
                            }
                            header( "refresh:2;url=revisarSolicitud.php");
                        }
                    }
                }
            }
            else
            {    
                if(empty($_GET['sol']))
                {
                    echo "<form method='POST' action='revisarSolicitud.php'>
                    <label for=''>Cambiar tipo de solicitudes</label>
                    <select name='estado'>
                    <option selected disabled hidden value=''>Elija el tipo de solicitud que desea revisar</option> 
                        <option value='Pendiente'>Solicitudes Pendientes</option>
                        <option value='Aceptado'>Solicitudes Aceptadas</option>
                        <option value='Rechazado'>Solicitudes Rechazadas</option>
                        <option value='Cancelado'>Solicitudes Canceladas</option>
                    </select>
                    <input type='submit' value='Cambiar'>
                    </form>";
                    if(empty($_POST['estado'])) $estado = "Pendiente";
                    else $estado = $_POST['estado'];
                    switch($estado)
                    {
                        case "Pendiente":
                            $heather = "pendientes";
                            $mensajeSino = "<h3>Usted no tiene solicitudes pendientes</h3>";
                            $aceptada = "Aceptada";
                            $rechazada = "Rechazada";
                            break;
                        case "Aceptado":
                            $heather = "aceptadas";
                            $cancelada = "Cancelado";
                            $mensajeSino = "<h3>Aún no le han aceptado ninguna solicitud</h3>";                            break;
                        case "Rechazado":
                            $heather = "rechazadas";
                            $mensajeSino = "<h3>No tiene solicitudes rechazadas</h3>";
                            break;
                        case "Cancelado":
                            $heather = "canceladas";
                            $mensajeSino = "<h3>No tiene solicitudes canceladas</h3>";
                            break;
                    }
                    echo "<h2>Solicitudes $heather</h2>";
                    $querySelect = "SELECT s.id_solicitud AS idSol,m.nombreMateria AS nombreMat,
                                    a.nombre AS nombreA,
                                    e.grado AS gradito,
                                    e.grupo AS grupito,
                                    s.estado AS estado
                                    FROM solicitud AS s
                                    INNER JOIN asesores AS a
                                    ON s.id_asesor = a.idAsesor
                                    INNER JOIN materias AS m
                                    ON m.idMateria = s.id_materia
                                    INNER JOIN estudiante AS e
                                    on s.id_estudiante = e.numCuenta
                                    WHERE s.estado = '$estado'
                                    AND e.numCuenta = '$numCuenta' ";
                    if($result =  mysqli_query($con,$querySelect))
                    {
                        if(mysqli_num_rows($result) > 0)
                        {
                            echo "<div class='single-table'>
                            <div class='table-responsive'>
                                <table class='table text-dark text-center'>
                                    <thead class='text-uppercase'>
                                        <tr class='table-active'>
                                <tr><th>Nombre Asesor</th>
                                <th>Materia que solicita</th>
                                <th>Grado y Grupo del Asesorado</th>
                                <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>";
                            if($estado == "Aceptado") echo "<th>Cancelar</th></tr>";
                            else echo "</tr>";
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                $idSolicitud = $rows['idSol'];
                                echo "<tr>";
                                echo "<td>" . $rows['nombreA'] . "</td>";
                                echo "<td>" . $rows['nombreMat'] . "</td>";
                                echo "<td>" . $rows['gradito'] . "-" . $rows['grupito'] . "</td>";
                                echo "<td>" . $rows['estado'] . "</td>";
                                if($estado == 'Aceptado')
                                {
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$cancelada&idSol=$idSolicitud' onclick='if(!confirm(\"¿Seguro que desea cancelar la solicitud?\")){return false;}'>Cancelar</a></buton></td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        else
                        {
                            echo $mensajeSino;
                        }
                    }
                }
                else
                {
                    $idSolicitud = $_GET['idSol'];
                    echo "<h2>Se ha Cancelado la solicitud</h2>";
                    $sqlActualizarSol = "UPDATE solicitud
                                        SET estado = 'Cancelado'
                                        WHERE id_solicitud = $idSolicitud";
                    if($result2 = mysqli_query($con,$sqlActualizarSol))
                    {
                        $sqlBorrarAgenda = "DELETE FROM Agenda
                                            WHERE id_sol = $idSolicitud";
                        $resultBorrar = mysqli_query($con,$sqlBorrarAgenda);
                        header( "refresh:2;url=revisarSolicitud.php");
                    }
                }
            }
            ?>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
