<?php
include("../header.php");
require '../conexion.php';
$ID = $_GET['id'];
$con = conectar();

$borrar = "DELETE FROM materiasimpartidas WHERE idAsesor = '$ID'";
$query = "DELETE FROM asesores WHERE idAsesor = '$ID'";
$delete = "DELETE FROM solicitud WHERE idasesor = '$ID'";
$delete2 = "DELETE FROM asesoresdisp WHERE idAsesor = '$ID'";
 

if(mysqli_query($con,$borrar) == TRUE | mysqli_query($con,$query) == true |  mysqli_query($con,$delete) == true | mysqli_query($con,$delete2) == true ){
            echo "El asesor se ha eliminado con éxito";
            header("location: tablaasesores.php");
            }else{
             echo "No se pudo eliminar al asesor";
            }
?> 

?>