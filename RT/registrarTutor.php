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
            <?php
                //Se requiere para mandar a llamar a la base de datos
                require_once("../conexion.php");
                $con = conectar();
                $error = "";
                //Si algunos de los campos están vacíos se devuelve a la página anterior
                if( empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo'])
                    || empty($_POST['pass']) || empty($_POST['confirmar']))
                {
                    $error = "Faltan campos para rellenar";
                    header("Location:register.php?error=$error");
                }
                else
                {
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $pass = $_POST['pass'];
                    $telefono = $_POST['telefono'];
                    $correo = $_POST['correo'];
                    //Verifica la integridad de la información o si concuerdan las contraseñas
                    $queryBuscar = "SELECT * FROM responsabletutorias
                    WHERE '$id' = numeroCuenta";
                    if($result = mysqli_query($con,$queryBuscar))
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
                    if(!preg_match("/[0-9]*/",$id) || strlen($id) != 8)
                    {
                        $error = "El número de cuenta no es un valor númerico o no tiene longitud válida";
                    }
                    if(!is_string($nombre) || !preg_match("/[a-zA-Z ñáéíóú]*/",$nombre))
                    {
                        if($error != "") $error .= '<br>';
                        $error .= "El nombre tiene un carácter inválido: los valores son letras mayúsculas o minúsculas o con acento gráfico";
                    }
                    if(!filter_var($correo,FILTER_VALIDATE_EMAIL))
                    {
                        if($error != "") $error .= '<br>';
                        $error .= "La dirección de correo electrónica es inválida";
                    }
                    if(strlen($telefono) != 10 || !preg_match("/[0-9]+/",$telefono))
                    {
                        if($error != "") $error .= '<br>';
                        $error .= "El número de teléfono es inválido";
                    }
                    if($pass != $_POST['confirmar'])
                    {
                        if($error != "") $error .= '<br>';
                        $error .= "Las contraseñas no concuerdan";
                    }
                    $pattern = "((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,21})";
                    if(!preg_match($pattern,$pass))
                    {
                        if($error != "") $error .= '<br>';
                        $error .= "Las contraseñas no concuerda con el patrón establecido: 1 mayúscula, 1 minúscula y 1 dígito";
                    }
                    if($error != "") header("Location:register.php?error=$error");
                    else
                    {
                        $queryInsertar = "INSERT INTO responsabletutorias(numeroCuenta,password,nombre,correo,celular)
                        VALUES('$id','$pass','$nombre','$correo','$telefono')";
                        if($query = mysqli_query($con,$queryInsertar))
                        {
                            echo '<h2> El usuario se ha registrado correctamente!</h2>';
                            echo '<h3> Se rediccionará a la página de inicio en unos segundos</h3>';
                            header( "refresh:5;url=index.php" );    
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>