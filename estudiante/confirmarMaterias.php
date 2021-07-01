<?php 
    require_once("../conexion.php");
    session_start();
    $con = conectar(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Solicitud de Asesoría</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <body>
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
                    echo "<h2>Pito</h2>";
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
                        echo "<table>";
                        echo "<tr><th>Nombre del Asesor</th><th>Días que Imparte la Clase</th><th>Grado y Grupo</th><th>Solicitar</th></tr>";
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
            header( "refresh:5;url=solicitud.php" );  
        ?>
        <?php endif; ?> 
        </div>
    </body>
</html>