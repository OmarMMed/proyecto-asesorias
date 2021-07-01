<?php
include("../header.php");
require ("../conexion.php");

if(isset($_SESSION['estudiante'])){
    header("Location: ../estudiante/estudiantes.php");
  }
  elseif(isset($_SESSION['rt'])){
    header("Location: ../RT/login_rt.php");
  }
  //confirmar inicio de sesión del RT
  if(!isset($_SESSION['asesor'])){
    header("Location: ../login.php");
}

echo '<h2> El usuario se ha registrado correctamente!</h2>';
            echo '<h3> Se rediccionará a la página de inicio en unos segundos</h3>';
            header( "refresh:5;url=perfil_asesor.php" );  

$con = conectar();
$id = $_SESSION['asesor'];

//Eliminar datos exitentes
$sql = "DELETE FROM materiasimpartidas WHERE idAsesor = '$id'";
$datosAlumno = mysqli_query($con,$sql);

if(!empty($_POST['primero']))
{
    foreach($_POST['primero'] as $selected)
    {
        $queryMateria = "SELECT idMateria from materias where nombreMateria = '$selected' LIMIT 1";
        if ($datosMateria = mysqli_query($con,$queryMateria))
        {
            while($filaMateria = mysqli_fetch_assoc($datosMateria))
            {
                
                $idMateria = $filaMateria['idMateria'];
                $sql = "INSERT INTO materiasimpartidas (idAsesor,idMateria,disponibilidad)
                        VALUES('$id','$idMateria','S')";
                $resultado = mysqli_query($con,$sql);
            }
        }
    }
}
    if(!empty($_POST['segundo']))
    {
        foreach($_POST['segundo'] as $selected)
        {
            $queryMateria = "SELECT idMateria from materias where nombreMateria = '$selected' LIMIT 1";
            if ($datosMateria = mysqli_query($con,$queryMateria))
            {
                while($filaMateria = mysqli_fetch_assoc($datosMateria))
                {
                    $idMateria = $filaMateria['idMateria'];
                    $sql = "INSERT INTO materiasimpartidas (idAsesor,idMateria,disponibilidad)
                            VALUES('$id','$idMateria','S')";
                    $resultado = mysqli_query($con,$sql);
                }
            }
        }
    }
    if(!empty($_POST['tercero']))
    {
        foreach($_POST['tercero'] as $selected)
        {
            $queryMateria = "SELECT idMateria from materias where nombreMateria = '$selected' LIMIT 1";
            if ($datosMateria = mysqli_query($con,$queryMateria))
            {
                while($filaMateria = mysqli_fetch_assoc($datosMateria))
                {
                    $idMateria = $filaMateria['idMateria'];
                    $sql = "INSERT INTO materiasimpartidas (idAsesor,idMateria,disponibilidad)
                            VALUES($id,$idMateria,'S')";
                    $resultado = mysqli_query($con,$sql);
                }
            }
    }
    if(!empty($_POST['cuarto']))
    {
        foreach($_POST['cuarto'] as $selected)
        {
            $queryMateria = "SELECT idMateria from materias where nombreMateria = '$selected' LIMIT 1";
            if ($datosMateria = mysqli_query($con,$queryMateria))
            {
                while($filaMateria = mysqli_fetch_assoc($datosMateria))
                {
                    $idMateria = $filaMateria['idMateria'];
                    $sql = "INSERT INTO materiasimpartidas (idAsesor,idMateria,disponibilidad)
                            VALUES($id,$idMateria,'S')";
                    $resultado = mysqli_query($con,$sql);
                }
            }
        }
    }
    if(!empty($_POST['quinto']))
    {
        foreach($_POST['quinto'] as $selected)
        {
            $queryMateria = "SELECT idMateria from materias where nombreMateria = '$selected' LIMIT 1";
            if ($datosMateria = mysqli_query($con,$queryMateria))
            {
                while($filaMateria = mysqli_fetch_assoc($datosMateria))
                {
                    $idMateria = $filaMateria['idMateria'];
                    $sql = "INSERT INTO materiasimpartidas (idAsesor,idMateria,disponibilidad)
                            VALUES($id,$idMateria,'S')";
                    $resultado = mysqli_query($con,$sql);
                }
            }
        }
    }   
    
}


?>