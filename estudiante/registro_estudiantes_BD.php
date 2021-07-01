<?php 
require("../conexion.php");
$error = "";
if(empty($_POST['numCuenta']) || empty($_POST['nombreCompleto']) || empty($_POST['pwd']) ||
  empty($_POST['carrera']) || empty($_POST['grado']) || empty($_POST['grupo']) ||
  empty($_POST['turno']) || empty($_POST['promedio']) || empty($_POST['celular']))
  {
    $error = "Uno o más campos están vacíos";
    header("Location:register.php?error=$error");
  }
  else
  {
    // Crear la conexion al servidor de base de datos
    $conn=new mysqli($servidor, $usuario, $pwd, $bd);
    if ($conn -> connect_error) 
    {
      die("Error al momento de conectar al servidor: " . $conn->connect_error);
    }

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

    //Verifica que no exista un estudiante con ese número de cuenta
    $queryBuscar = "SELECT * FROM estudiante
    WHERE '$numCuenta' = numCuenta";
    if($result = mysqli_query($conn,$queryBuscar))
    {
        if($existeUsuario = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            if($existeUsuario[0] > 1)
            { 
                $error = "Ya existe ese número de cuenta";
                header("Location:register.php?error=$error");
            } 
        }
    }
    //Verifica la integridad de la información
    
    if(!preg_match("/[0-9]*/",$numCuenta) || strlen($numCuenta) != 8)
    {
        $error = "El número de cuenta no es un valor númerico o no tiene longitud válida";
    }
    if(!is_string($nombreCompleto) || !preg_match("/[a-zA-Z ñáéíóú]*/",$nombreCompleto))
    {
        if($error != "") $error .= '<br>';
        $error .= "El nombre tiene un carácter inválido: los valores son letras mayúsculas o minúsculas o con acento gráfico";
    }
    if(!filter_var($correo,FILTER_VALIDATE_EMAIL))
    {
        if($error != "") $error .= '<br>';
        $error .= "La dirección de correo electrónica es inválida";
    }
    if(strlen($celular) != 10 || !preg_match("/[0-9]+/",$celular))
    {
        if($error != "") $error .= '<br>';
        $error .= "El número de teléfono es inválido";
    }
    if(!is_numeric($promedio))
    {
      if($error != "") $error .= '<br>';
      $error .= "El promedio es inválido";
    }
    $pattern = "((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,21})";
    if(!preg_match($pattern,$pwd))
    {
        if($error != "") $error .= '<br>';
        $error .= "La contraseña  no cuenta con el patrón establecido: 1 mayúscula, 1 minúscula y 1 dígito";
    }
    if($pwd != $_POST['confirmar'])
    {
        if($error != "") $error .= '<br>';
        $error .= "Las contraseñas no concuerdan";
    }
    if($error != "")
    {
      header("Location:register.php?error=$error");
    }
    else
    {
      $insertar= "INSERT INTO estudiante (numCuenta,nombreCompleto,password,carrera,grado,turno,grupo,promedio,celular,correo) 
      VALUES ('$numCuenta','$nombreCompleto','$pwd','$carrera',$grado,'$turno',$grupo,$promedio,'$celular','$correo')";
      $Resultado= $conn->query($insertar);
      //$sql="SELECT * from clientes";
      //$result=$conn->query($sql);
      if ($conn -> connect_error) 
      {
        die("Error al momento de conectar al servidor: " . $conn->connect_error);
      }
      else
      {
        echo "<h2>Se guardo correctamente</h2>";
        header( "refresh:3;url=index.php" );
      }
    }
    $conn ->close();
  }
?>