<?php
include("../header.php");
require '../conexion.php';
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
<html>
<head>
	<title>LOGIN</title>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  }
<style>
body {
   font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
	
}
form {
   max-width: 550px;
   margin: auto;
}
.inputContainer i {
    position: absolute;
    left: 30;
}
.inputContainer {
   width: 100%;
   margin-bottom: 10px;
	text-align: left
}
.icon {
   padding: 12px;
   color: black;
   width: 70px;
   text-align: left;
}
.Field {
   width: 100%;
   padding: 10px;
   text-align: center;
   font-size: 20px;
   font-weight: 500;
}
	input {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border: 1px solid #ccc;
  border-radius: .1875rem;
  box-sizing: border-box;
  display: block;
  font-size: .875rem;
  margin-bottom: 1rem;
  padding: .275rem;
  width: 100%;
		background-color: 
}
	input[type="checkbox"] {
  -webkit-appearance: checkbox;
     -moz-appearance: checkbox;
          appearance: checkbox;
  display: inline-block;
  width: auto;
	  color: #fff;
}
	input[type="submit"] {
  background-color: #a51316;
  border: 10px;
		border-color: #000000;
  color: #fff;
  font-size: 1rem;
  padding: .5rem 1rem;
		width: 60%;
text-align: center;
	
			
}
	a {
    color: #fff;
    text-align: center;
		
			
}
	.column-left{ float: left; width: 33.333%; }
.column-right{ float: right; width: 33.333%; }
.column-center{ display: inline-block; width: 33.333%; }

	.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Control the left side */
.left {
  left: 0;
  background-color: #FFFFFF;

}

/* Control the right side */
.right {
  right: 0;
background-color: #2384d5;
}

/* If you want the content centered horizontally and vertically */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

/* Style the image inside the centered container, if needed */
.centered img {
  width: 150px;
  border-radius: 50%;
}
</style>
</head>
<body>



	<div class="split left">
  	
     <img src="Lo.jpg">
  </div>
</div>


<div class="split right">
	
  <div class="centered">



<h1 style="text-align: center; color: white">INICIA SESIÓN</h1><br>
<form action="login_rt.php" method="post">
  <div class="inputContainer">
  <i class="fa material-icons icon">person_outline</i>
  <input class="Field" type="text" placeholder="Numero de cuenta" name="num"/>
  </div>
  <div class="inputContainer">
  <i class="fa material-icons icon">lock_open</i>
  <input class="Field" type="password" placeholder="Contraseña" name="contrasena"/>
  </div>
    <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Recordarme</label>    <a href="url"><br>Olvidé mi contraseña </a><br><br>
    <input type="submit" name="login-submit" value="Iniciar Sesión" onclick="lsRememberMe()">


      <div class="container">
    <div class="column-left">Crea una nueva cuenta</div>
    <div class="column-right"><a href="register.php">Registrarme como RT</a></div><br><br><br>
</form>
  </div>
</div>
</div>

</body>
</html> '
;} ?>