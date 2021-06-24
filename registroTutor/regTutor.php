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
            <form action="registrarTutor.php" method="post">
                <h2>Ingrese sus datos</h2>
                <?php if(isset($_GET['error']))
                { 
                    $error = $_GET['error'];
                    echo '<strong style="color: red">'. $error .'</strong><br>';
                }
                ?>
                <label for="id">Ingrese su número de cuenta:</label><br>
                <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8">
                </p>
                <label for="nombre">Ingrese su nombre:</label><br>
                <input type="text" name="nombre" pattern="[A-Za-z áéíóúñ]*" maxlength="50">
                </p>
                <label for="correo">Ingrese su correo electrónico:</label><br>
                <input type="email" name="correo" maxlength="40">
                </p>
                <label for="telefono">Ingrese su número de teléfono:</label><br>
                <input type="text" name="telefono" pattern="[0-9]*" minlength="10" maxlength="10">
                </p>
                <label for="pass">Ingrese su contraseña:</label><br>
                <input type="password" name="pass" maxlength="20">
                </p>
                <label for="pass">Confirme su contraseña:</label><br>
                <input type="password" name="confirmar" maxlength="20">
                </p>
                <input type="submit" value="Registrar Tutor" name="registro">
            </form>
        </div>
    </body>
</html>