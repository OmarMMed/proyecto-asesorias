<?php
include("cabecera_estudiante.php");

$num = $_SESSION['estudiante'];

$con = conectar();

    $query = "SELECT * FROM estudiante WHERE numCuenta = '$num'";
    $result = $con->query($query);
    $row = $result->fetch_object();
    $_numCuenta = $row->numCuenta;
    $_pass = $row->password;
    $_nombre = $row->nombreCompleto;
    $_correo = $row->correo;
    $_celular = $row->celular;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro estudiante</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Perfil estudiante</h2>
                        <form action="editar_perfil_estudiante.php" method="post">
                            <h3>Perfil de: <?=$_nombre?></h3>
                            <?php if(isset($_GET['error']))
                            { 
                                $error = $_GET['error'];
                                echo '<strong style="color: red">'. $error .'</strong><br>';
                            }
                            ?>
                            <labe>Numero de Cuenta:</label>
                            <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8" value="<?=$_numCuenta?>" readonly=»readonly>
                            </p>
                            <labe>Nombre:</label>
                            <input type="text" name="nombre" pattern="[A-Za-z áéíóúñ]*" maxlength="50" placeholder="Nombre completo" value="<?=$_nombre?>">
                            </p>
                            <labe>Correo electronico:</label>
                            <input type="email" name="correo" maxlength="40" placeholder="Correo Electronico" value=<?=$_correo?>>
                            </p>
                            <labe>Celular:</label>
                            <input type="text" name="telefono" pattern="[0-9]*" minlength="10" maxlength="10" placeholder="Celular" value=<?=$_celular?>>
                            </p>
                            <input type="submit"  class="btn btn-success" value="Editar perfil" name="editar">
                        </form>

                        <form action="borrar_estudiante.php" method="POST" onsubmit="if(!confirm('Seguro que desea borrar?')){return false;}">
                            <input type="submit" class="btn btn-danger" value="borrar perfil" name="borrar">
                        </form>
                        <form action="estudiantes.php">
                            <input type="submit" class="btn btn-primary" value="Regresar" >
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="" class="signup-image-link"></a>
                    </div>
                </div>
            </div>
        </section>


<?php include("footer_estudiante.php") ?>
