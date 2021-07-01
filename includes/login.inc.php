<?php
if(isset($_POST['login-submit'])){

    require '../conexion.php';
    $conn=new mysqli($servidor, $usuario, $pwd, $bd);
    $mailuid = $_POST['num'];
    $password = $_POST['contrasena'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();  
    }
    else{
        $sql = "SELECT * FROM estudiante WHERE numCuenta='$mailuid'";
        $total = mysqli_num_rows(mysqli_query($conn,$sql));
        if($total == 0){
            $sql = "SELECT * FROM asesores WHERE idAsesor ='$mailuid'";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    
                    header("Location: ../index.php?error=wrongpassword");

                    exit();
                }
                else if($password == $row['password']){
                    session_start();
                    $_SESSION['asesor'] = $mailuid;

                    
                    header("Location: ../asesor/asesores.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }else{
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    
                    header("Location: ../index.php?error=wrongpassword");

                    exit();
                }
                else if($password == $row['password']){
                    session_start();
                    $_SESSION['estudiante'] = $mailuid;

                    
                    header("Location: ../estudiante/estudiantes.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

}
else{
    header("Location: ../index.php");
    exit();
}
?>