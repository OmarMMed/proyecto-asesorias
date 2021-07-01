<?php
include ("../header.php");
require_once("../conexion.php");
$con = conectar();




$id = $_SESSION['asesor'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$carrera = $_POST['carrera'];
$grado = $_POST['grado'];
$grupo = $_POST['grupo'];
$horario = $_POST['horario'];


    //Concatena una cadena con todos los días que un alumno da clase
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
    $dias = $diasDisponibles;

 
if(!isset($_GET['error']))
{
    if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['carrera']) || empty($_POST['grupo']) || empty($_POST['grado']) || empty($_POST['horario'])|| 
    (empty($_POST['lunes']) && empty($_POST['martes']) && empty($_POST['miercoles']) && empty($_POST['jueves']) && empty($_POST['viernes'])))
    {
            $error = "Faltan campos para rellenar";        
            header("Location:../asesor/perfil_asesor.php?error=$error");
    }else{

        $queryActualizar = "UPDATE asesores SET nombre = '$nombre', correo = '$correo', celular = '$telefono', grado = '$grado',
        grupo = '$grupo', carrera = '$carrera', diasDisponibles = '$dias', horario = '$horario' WHERE idAsesor = '$id'";
                
                        if(mysqli_query($con,$queryActualizar) == TRUE)
                        {
                            echo '<h2> El usuario se ha actualizado correctamente!</h2>';
                            echo '<h3> Se rediccionará a la página de inicio en unos segundos</h3>';
                            header( "refresh:3;url=../asesor/perfil_asesor.php" );    
                        }else{
                            echo 'No se pudo actualizar';
                        }

    }


}
?>