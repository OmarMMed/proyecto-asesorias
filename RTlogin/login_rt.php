<?php
if(isset($_POST['login-submit'])){

    require '../conexion.php';
    $conn=new mysqli($servidor, $usuario, $pwd, $bd);
    $mailuid = $_POST['num'];
    $password = $_POST['contrasena'];

    if(empty($mailuid) || empty($password)){
        header("Location: index_rt.php?error=emptyfields");
        exit();  
    }
    else{
        $sql = "SELECT * FROM responsabletutorias WHERE numeroCuenta ='$mailuid'";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: index_rt.php?error=wrongpassword");
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                if($password != $row['password']){
                    
                    header("Location: index_rt.php?error=wrongpassword");

                    exit();
                }
                else if($password == $row['password']){
                    session_start();
                    $_SESSION['rt'] = $mailuid;

                    
                    header("Location: ../rt.php?login=success");
                    exit();
                }
                else{
                    header("Location: index_rt.php?error=wrongpassword");
                    exit(); 
                }
            }
            else{
                header("Location: index_rt.php?error=nouser");
                exit();
            }
        }
    }

}
else{
    header("Location: index_rt.php");
    exit();
}