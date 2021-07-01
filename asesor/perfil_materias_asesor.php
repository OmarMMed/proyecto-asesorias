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



$con = conectar();

?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Perfil de Asesor</title>
        <link rel="stylesheet" href="../estilos.css">
        <script src="scripts.js"></script>
    </head>
    <body>
<div class="contenedor">
    <h2>Elege las nuevas materias que quieres impartir</h2>
    <form method="post" action="editar_materias.php">
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
                <input type="submit" value="Elegir materias">
            </form>
            <form action="perfil_asesor.php">
                    <input type="submit" value="Regresar" name="registro">
            </form>
</div>

</body>
</html>