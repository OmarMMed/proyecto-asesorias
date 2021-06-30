<?php
include("header.php");
require 'conexion.php';
if(isset($_SESSION['asesor'])){
  header("Location: asesores.php");
}
elseif(isset($_SESSION['estudiante'])){
  header("Location: estudiantes.php");
}
elseif(isset($_SESSION['rt'])){
  header("Location: rt.php");
}
else{ echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asesorias Par - FIC</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>


        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="estudiante/register.php" class="signup-image-link">Crear una cuenta como estudiante</a> <br>
                        <a href="asesor/regAsesor.php" class="signup-image-link">Crear una cuenta como asesor par</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" action="includes/login.inc.php" method="post">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input class="Field" type="text" placeholder="Numero de cuenta" name="num"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input class="Field" type="password" placeholder="Contraseña" name="contrasena"/>
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit"  name="login-submit" id="submit" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <footer>
                    <div class="footer-area">
                        <p>Departamento de Tutorias de la Facultad de Informática Culiacán <a href="https://fic.uas.edu.mx/"> Pagina web</a>.</p>
                    </div>
                </footer>
            </div>

            
        </section>

        

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>'; } ?>