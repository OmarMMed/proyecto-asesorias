<!DOCTYPE html>
<?php 
    session_start();
    require_once("../conexion.php");
    $con = conectar();
    $numCuenta = "14430101";
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
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Solicitud de Asesoría</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <body>
    <div class="contenedor">
            <?php if(empty($_POST['grado']) && empty($_POST['materia']) || isset($_GET['error'])) : ?>
            <h2>Selecciona el semestre del que desea tomar asesorías</h2>
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
                    </select>
                <input type="submit" value="Elegir grado">
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
    </body>
</html>