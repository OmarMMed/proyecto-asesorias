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
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $sql = "SELECT * FROM asesores WHERE idAsesor='$mailuid'";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=sqlerror");
                exit();  
            }else{
                mysqli_stmt_bind_param($stmt, "ss", $mailuid);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    
                    header("Location: ../index.php?error=wrongpassword");

                    exit();
                }
                else if($password == $row['password']){
                    session_start();
                    $_SESSION['asesor'] = $mailuid;

                    
                    header("Location: ../asesores.php?login=success");
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
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    
                    header("Location: ../index.php?error=wrongpassword");

                    exit();
                }
                else if($password == $row['password']){
                    session_start();
                    $_SESSION['estudiante'] = $mailuid;

                    
                    header("Location: ../estudiante.php?login=success");
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