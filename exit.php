<?php
include("header.php");

if(!empty($_SESSION['rt'])){
    session_destroy();
    echo '<h1>Redirigiendo......</h1>';
    header( "refresh:2;url=rt/index.php" );  
}else{
    session_destroy();
    echo '<h1>Redirigiendo......</h1>';
    header( "refresh:2;url=index.php" );  
}

?>