<?php
    require_once("../conexion.php");
    session_start();
    $con = conectar();
    $esEstutudiante = TRUE;
    $id = 1;
    $numCuenta = "14430101";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Solicitud de Asesoría</title>
        <link rel="stylesheet" href="../estilos.css">
        <script>
        </script>
    </head>
    <body>
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
                    <input type='submit' value='Cambiar'>
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
                            $heather = "aceptados";
                            $cancelada = "Cancelado";
                            $mensajeSino = "<h3>Usted no tiene solicitudes pendientes</h3>";
                            $mensajeSino = "<h3>Usted no ha aceptado ninguna solicitud aún</h3>";
                            break;
                        case "Rechazado":
                            $heather = "rechazadas";
                            $mensajeSino = "<h3>Usted no ha rechazado ninguna solicitud aún</h3>";
                            break;
                        case "Cancelado":
                            $heather = "canceladas";
                            $mensajeSino = "<h3>Usted no ha aceptado ninguna solicitud aún</h3>";
                            break;
                    }
                    $querySelect = "SELECT s.id_solicitud AS idSol,m.nombreMateria AS nombreMat,
                                    e.nombreCompleto AS nombreE,
                                    e.grado AS gradito,
                                    e.grupo AS grupito
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
                            echo "<table>
                                <tr><th>Nombre Asesorado</th>
                                <th>Materia que solicita</th>
                                <th>Grado y Grupo del Asesorado</th>";
                                if($estado == "Pendiente")
                                {
                                    echo "<th>Aceptar</th>
                                    <th>Rechazar</th></tr>";
                                }
                                else if($estado == "Aceptado")
                                {
                                    echo "<th>Cancelar</th></tr>";
                                }
                                else 
                                {
                                    echo "</tr>";
                                }
                            
                            while($rows = mysqli_fetch_assoc($result))
                            {
                                $idSolicitud = $rows['idSol'];
                                echo "<tr>";
                                echo "<td>" . $rows['nombreE'] . "</td>";
                                echo "<td>" . $rows['nombreMat'] . "</td>";
                                echo "<td>" . $rows['gradito'] . "-" . $rows['grupito'] . "</td>";
                                if($estado == "Pendiente")
                                {
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$aceptada&idSol=$idSolicitud'>Aceptar</a></buton></td>";
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$rechazada&idSol=$idSolicitud'>Rechazar</a></buton></td>";
                                }
                                else if($estado == "Aceptado")
                                {
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$cancelada&idSol=$idSolicitud'>Cancelar</a></buton></td>";
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
                                    $sqlAgendar = "INSERT INTO agenda (nombreMateria,Fecha,nombreEstudiante,nombreAsesor,grupoEstudiante,carrera)
                                                VALUES ('$nombreMat','$fecha','$nombreEstudiante','$nombreAsesor','$grupoEstudiante','$carrera')";
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
                        if($_GET['sol'] = "Cancelada") $estado = "Cancelado";
                        echo "<h2>Se ha $estado la solicitud!</h2>";
                        $sqlActualizarSol = "UPDATE solicitud
                                            SET estado = '$estado'
                                            WHERE id_solicitud = $idSolicitud";
                        if($result2 = mysqli_query($con,$sqlActualizarSol))
                        {
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
                            $heather = "aceptados";
                            $cancelada = "Cancelado";
                            $mensajeSino = "<h3>Usted no tiene solicitudes pendientes</h3>";
                            $mensajeSino = "<h3>Usted no ha aceptado ninguna solicitud aún</h3>";
                            break;
                        case "Rechazado":
                            $heather = "rechazadas";
                            $mensajeSino = "<h3>Usted no ha rechazado ninguna solicitud aún</h3>";
                            break;
                        case "Cancelado":
                            $heather = "canceladas";
                            $mensajeSino = "<h3>Usted no ha aceptado ninguna solicitud aún</h3>";
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
                            echo "<table>
                                <tr><th>Nombre Asesor</th>
                                <th>Materia que solicita</th>
                                <th>Grado y Grupo del Asesorado</th>
                                <th>Estado</th>";
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
                                    echo "<td><button><a href='revisarSolicitud.php?sol=$cancelada&idSol=$idSolicitud'>Cancelar</a></buton></td>";
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
                        header( "refresh:2;url=revisarSolicitud.php");
                    }
                }
            }
            ?>
        </div>
    </body>
</html>