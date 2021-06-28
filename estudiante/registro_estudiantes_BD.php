<?php 
require("../conexion.php");

// Crear la conexion al servidor de base de datos
$conn=new mysqli($servidor, $usuario, $pwd, $bd);
if ($conn -> connect_error) 
{
  die("Error al momento de conectar al servidor: " . $conn->connect_error);
}else{

 $numCuenta=$_POST['numCuenta'] ;
 $nombreCompleto=$_POST['nombreCompleto'] ;
 $pwd=$_POST['pwd'] ; 
 $carrera=$_POST['carrera'] ; 
 $grado=$_POST['grado'] ; 
 $turno=$_POST['turno'] ; 
 $grupo=$_POST['grupo'] ; 
 $promedio=$_POST['promedio'] ; 
 $celular=$_POST['celular'] ; 
 $correo=$_POST['correo'] ; 

$insertar= "INSERT INTO estudiante (numCuenta,nombreCompleto,password,carrera,grado,turno,grupo,promedio,celular,correo) VALUES ('$numCuenta','$nombreCompleto','$pwd','$carrera','$grado','$turno','$grupo','$promedio','$celular','$correo')";
$result = mysqli_query($conn, $insertar);
//$sql="SELECT * from clientes";
//$result=$conn->query($sql)
header("Location: estudiantes.php")
}

$conn ->close();
 ?>