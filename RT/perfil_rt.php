<?php
include("../header.php");
require ("../conexion.php"); 

if(isset($_SESSION['asesor'])){
    header("Location: ../asesores/asesores.php");
  }
  elseif(isset($_SESSION['estudiante'])){
    header("Location: ../estudiante/estudiantes.php");
  }
  //confirmar inicio de sesión del RT
  if(!isset($_SESSION['rt'])){
    header("Location: ../RT/login_rt.php");
}
$num = $_SESSION['rt'];

$con = conectar();

    $query = "SELECT * FROM responsabletutorias WHERE numeroCuenta = '$num'";
    $result = $con->query($query);
    $row = $result->fetch_object();
    $_numCuenta = $row->numeroCuenta;
    $_pass = $row->password;
    $_nombre = $row->nombre;
    $_correo = $row->correo;
    $_celular = $row->celular;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro RT</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="main">
    
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Perfil RT</h2>
                        <form action="editar_perfil_rt.php" method="post">
                            <h3>Perfil de: <?=$_nombre?></h3>
                            <?php if(isset($_GET['error']))
                            { 
                                $error = $_GET['error'];
                                echo '<strong style="color: red">'. $error .'</strong><br>';
                            }
                            ?>
                            <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8" value="<?=$_numCuenta?>"  readonly=»readonly>
                            </p>
                            <input type="text" name="nombre" pattern="[A-Za-z áéíóúñ]*" maxlength="50" placeholder="Nombre completo" value="<?=$_nombre?>">
                            </p>
                            <h4>Perfil de: <?=$_nombre?></h4>
                            <input type="email" name="correo" maxlength="40" placeholder="Correo Electronico" value=<?=$_correo?>>
                            </p>
                            <input type="text" name="telefono" pattern="[0-9]*" minlength="10" maxlength="10" placeholder="Celular" value=<?=$_celular?>>
                            </p>
                            <input type="submit" value="Editar perfil" name="editar">
                        </form>

                        <form action="borrar_rt.php" method="POST" onsubmit="if(!confirm('Seguro que desea borrar?')){return false;}">
                            <input type="submit" value="borrar perfil" name="borrar">
                        </form>
                        <form action="rt.php">
                            <input type="submit" value="Regresar" name="registro">
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="" class="signup-image-link"></a>
                    </div>
                </div>
            </div>
        </section>
       
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        
