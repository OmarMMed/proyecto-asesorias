 <?php
include("../header.php");
require_once("../conexion.php");
$con = conectar();

$ID = $_SESSION['estudiante'];
echo $ID;

$query = "DELETE FROM estudiante WHERE numCuenta = '$ID'";

if(mysqli_query($con,$query) == true){
            echo "El cliente se ha eliminado con éxito";
            header("location: ../exit.php");
            }else{
             echo "No se pudo eliminar al cliente";
            }

?> 