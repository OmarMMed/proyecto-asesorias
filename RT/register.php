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
                        <h2 class="form-title">Registro RT</h2>
                        <form action="registrarTutor.php" method="post">
                            <h2>Ingrese sus datos</h2>
                            <?php if(isset($_GET['error']))
                            { 
                                $error = $_GET['error'];
                                echo '<strong style="color: red">'. $error .'</strong><br>';
                            }
                            ?>
                            <input type="text" name="id" pattern="[0-9]*" minlength="8" maxlength="8" placeholder="Numero de cuenta">
                            </p>
                            <input type="text" name="nombre" pattern="[A-Za-z áéíóúñ]*" maxlength="50" placeholder="Nombre completo">
                            </p>
                            <input type="email" name="correo" maxlength="40" placeholder="Correo Electronico">
                            </p>
                            <input type="text" name="telefono" pattern="[0-9]*" minlength="10" maxlength="10" placeholder="Celular">
                            </p>
                            <input type="password" name="pass" minlength="7" maxlength="20" placeholder="Contraseña">
                            </p>
                            <input type="password" name="confirmar" minlength="7" maxlength="20" placeholder="Confirme Contraseña">
                            </p>
                            <input type="submit" value="Registrar Tutor" name="registro">
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">Ya soy un usuario</a>
                    </div>
                </div>
            </div>
        </section>
       
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>