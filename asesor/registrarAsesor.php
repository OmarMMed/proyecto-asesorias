<?php require_once("../conexion.php")?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Registrar Asesor</title>
        <link rel="stylesheet" href="../estilos.css">
        <script src="../scripts.js"></script>
    </head>
    <body>
    <div class="contenedor">
        <?php
            //Si no se selecciona una materia, manda un error a la página anterior.
        if
        (
            empty($_POST['primero']) && empty($_POST['segundo']) &&
            empty($_POST['tercero']) && empty($_POST['cuarto']) &&
            empty($_POST['quinto'])
        )
        {
            $error = "No ha seleccionado ninguna materia.";
            header("Location:seleccionarMaterias.php?error=$error");
        }
        else
        {
            echo '<h1> El usuario se ha registrado correctamente!</h1>';
             
            //Se reciben las sesiones y se insertan en la base de datos
            require_once("../conexion.php");
            session_start();
            $id = 0;
            $diasDisponibles = $_SESSION['dias'];
            $nombre = $_SESSION['nombre'];
            $telefono = $_SESSION['telefono'];
            $correo = $_SESSION['correo'];
            $carrera = $_SESSION['carrera'];
            $grupo = $_SESSION['grupo'];
            $grado = $_SESSION['grado'];
            $horario = $_SESSION['horario'];
            $pass = $_SESSION['pass'];
            /******************************************************/
            session_destroy();
            /******************************************************/
            $insertar = "INSERT INTO asesores (nombre,celular,correo,carrera,grado,grupo,horario,diasDisponibles,password)
                            VALUES ('$nombre','$telefono','$correo','$carrera',$grado,$grupo,'$horario','$diasDisponibles','$pass')";

            $con = conectar();
            $query = mysqli_query($con,$insertar);
            $queryAlumno = "SELECT idAsesor from asesores where celular = '$telefono' LIMIT 1";
            if($datosAlumno = mysqli_query($con,$queryAlumno))
            {
                while($filaAlumno = mysqli_fetch_assoc($datosAlumno))
                {
                    $id = $filaAlumno['idAsesor'];
                }
            }
            echo '<h2>Este es tu id de Asesor: <b>'.$id.'</b> es muy importante que lo anotes ya que con el inicias sesión</h2><br>';
            echo '<h2>Cuando estes listo presiona <a href="../index.php">continuar</a></h2>';
            //header( "refresh:5;url=../index.php" );   
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
        }   
        ?>
    </div>
    </body>
</html>