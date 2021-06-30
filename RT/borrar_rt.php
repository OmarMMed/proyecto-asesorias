 <?php
include("../header.php");
require_once("../conexion.php");
$con = conectar();

$ID = $_SESSION['rt'];
echo $ID;

$query = "DELETE FROM responsabletutorias WHERE numeroCuenta = '$ID'";

if(mysqli_query($con,$query) == true){
            echo "El cliente se ha eliminado con éxito";
            header("location: ../exit.php");
            }else{
             echo "No se pudo eliminar al cliente";
            }

?> 