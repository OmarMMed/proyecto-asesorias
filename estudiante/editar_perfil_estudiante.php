<?php
                //Se requiere para mandar a llamar a la base de datos
                require_once("../conexion.php");
                $con = conectar();
                $error = "";

                
            if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo'])){
                $error = "Faltan campos por rellenar";
                header("Location: ../estudiante/perfil_estudiante.php?error=$error");
                }
            else{
                //Si algunos de los campos están vacíos se devuelve a la página anterior
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $correo = $_POST['correo'];
                    $telefono = $_POST['telefono'];
                    //Verifica la integridad de la información o si concuerdan las contraseñas
                   
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
                    
                    
                        $queryActualizar = "UPDATE estudiante SET nombreCompleto = '$nombre', correo = '$correo', celular = '$telefono' WHERE numCuenta = '$id'";
                
                        if(mysqli_query($con,$queryActualizar) == TRUE)
                        {
                            echo '<h2> El usuario se ha actualizado correctamente!</h2>';
                            echo '<h3> Se rediccionará a la página de inicio en unos segundos</h3>';
                            header( "refresh:10;url=../estudiante/perfil_estudiante.php" );    
                        }else{
                            echo 'No se pudo actualizar';
                        }
            }
            ?>