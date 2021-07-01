<?php

include ("../header.php");
require_once("../conexion.php");
$con = conectar();

$id = $_SESSION['asesor'];

$horario = $_POST['horario'];

if(isset($_POST['lunes'])) $diasDisponibles = $_POST['lunes'];
            if(isset($_POST['martes']))
            {
                if($diasDisponibles != "") $diasDisponibles .= " ";
                $diasDisponibles .= $_POST['martes'];
            }
            if(isset($_POST['miercoles']))
            {
                if($diasDisponibles != "") $diasDisponibles .= " ";
                $diasDisponibles .= $_POST['miercoles'];
            }
            if(isset($_POST['jueves']))
            {
                if($diasDisponibles != "") $diasDisponibles .= " ";
                $diasDisponibles .= $_POST['jueves'];
            }
            if(isset($_POST['viernes']))
            {
                if($diasDisponibles != "") $diasDisponibles .= " ";
                $diasDisponibles .= $_POST['viernes'];
            }

$queryActualizar = "UPDATE asesores SET diasDisponibles = '$diasDisponibles', horario = '$horario' WHERE idAsesor = '$id'";

if(mysqli_query($con,$queryActualizar) == TRUE)
{
    echo '<h2> El usuario se ha actualizado correctamente!</h2>';
    echo '<h3> Se rediccionará a la página de inicio en unos segundos</h3>';
    header( "refresh:3;url=../asesor/perfil_asesor.php" );    
}else{
    echo 'No se pudo actualizar';
}
?>