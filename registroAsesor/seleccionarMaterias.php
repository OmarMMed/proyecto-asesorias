<?php
    //Se requiere para mandar a llamar a la base de datos
    require("../conexion.php");
    $con = conectar();
    $error = "";
    //Si algunos de los campos están vacíos o si todos los campos del horario está vacío, manda el error a la página
    //anterior
    if(!isset($_GET['error']))
    {
        if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo'])
            || empty($_POST['carrera']) || empty($_POST['grupo']) || empty($_POST['grado'])
            || empty($_POST['horario']) ||
            (empty($_POST['lunes']) && empty($_POST['martes']) && empty($_POST['miercoles'])
            && empty($_POST['jueves']) && empty($_POST['viernes'])))
        {
            $error = "Faltan campos para rellenar";
            header("Location:regAsesor.php?error=$error");
        }
        else
        {
            //Se crea una sesión para poder trabajar con la página siguiente. Los valores los recibe por POST
            session_start();
            $diasDisponibles = "";
            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['telefono'] = $_POST['telefono'];
            $_SESSION['correo'] = $_POST['correo'];
            $_SESSION['carrera'] = $_POST['carrera'];
            $_SESSION['grupo'] = $_POST['grupo'];
            $_SESSION['grado'] = $_POST['grado'];
            $_SESSION['horario'] = $_POST['horario'];

            //Valida que los elementos dados sean válidos
            if(!is_string($_SESSION['nombre']) || !preg_match("/[a-zA-Z ñáéíóú]*/",$_SESSION['nombre']))
            {
                $error = "El nombre tiene un carácter inválido: los valores son letras mayúsculas o minúsculas o con acento gráfico";
            }
            if(!filter_var($_SESSION['correo'],FILTER_VALIDATE_EMAIL))
            {
                if($error != "") $error .= '<br>';
                $error .= "La dirección de correo electrónica es inválida";
            }
            if(strlen($_SESSION['telefono']) != 10 || !preg_match("/[0-9]+/",$_SESSION['telefono']))
            {
                if($error != "") $error .= '<br>';
                $error .= "El número de teléfono es inválido";
            }
            if($error != "") header("Location:regAsesor.php?error=$error");

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
            $_SESSION['dias'] = $diasDisponibles;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Registrar Asesor</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <body>
    <div class="contenedor">
            <form method="post" action="registrarAsesor.php">
                <h2>Materias a las que desea dar clase:</h2></p>
                <?php
                    if (isset($_GET['error']))
                    {
                        $error = $_GET['error'];
                        echo '<strong style="color: red">'. $error .'</strong><br>';
                    }
                ?>
                    <strong>Primer Año</strong><br>
                        <select  name="primero[]" id="first" multiple>
                        <?php
                        //Manda a llamar una función que llena el select
                        //Esto se repite 5 veces. 1 Por cada año de la carrera.
                        $select1 = "SELECT * FROM materias
                        WHERE (semestre >= 1 AND semestre <= 2)";
                        if($_SESSION['carrera'] != "ITSE")
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
                    <strong>Segundo Año</strong><br>
                        <select name="segundo[]" multiple>
                            <?php
                            $select2 = "SELECT * FROM materias WHERE 
                            (semestre >= 3 AND semestre <= 4)";
                            if($_SESSION['carrera'] != "ITSE")
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
                    <strong>Tercer Año</strong><br>
                    <select name="tercero[]" multiple>
                        <?php
                            $select3 = "SELECT * FROM materias WHERE 
                            (semestre >= 5 AND semestre <= 6)";
                            if($_SESSION['carrera'] != "ITSE")
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
                    <strong>Cuarto Año</strong><br>
                    <select name="cuarto[]" multiple>
                        <?php
                            $select4 = "SELECT * FROM materias WHERE 
                            semestre >= 7 AND semestre <= 8";
                            $result4 = mysqli_query($con,$select2);
                            
                            if($_SESSION['carrera'] != "ITSE")
                            {
                                $select4 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select4 .= " AND categorias = 'ITSE'";
                            }
                            if($result4)
                            {
                                while($rows = mysqli_fetch_assoc($result4))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    </p>
                    <strong>Quinto Año</strong><br>
                    <select name="quinto[]" multiple >
                        <?php
                            $select5 = "SELECT * FROM materias WHERE 
                            semestre >= 9";
                            if($_SESSION['carrera'] != "ITSE")
                            {
                                $select5 .= " AND categorias != 'ITSE'";
                            }
                            else
                            {
                                $select5 .= " AND categorias = 'ITSE'";
                            }
                            $result5 = mysqli_query($con,$select2);

                            if($result5)
                            {
                                while($rows = mysqli_fetch_assoc($result5))
                                {
                                    echo "<option value='" .$rows['nombreMateria'] . "'>" . $rows["nombreMateria"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </p>
                <label><b>Si desea seleccionar mas de una materia presione ctrl + click izquierdo sobre el nombre de la materia</b></label>
                <input type="submit" value="Elegir materias">
            </form>
        </div>
    </body>
</html>