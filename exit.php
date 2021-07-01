<?php
include("header.php");
session_destroy();
echo '<h1>Redirigiendo......</h1>';
header( "refresh:2;url=index.php" );  
?>