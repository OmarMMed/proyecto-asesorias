<?php

$servidor = "localhost";
$usuario = "root";
$pwd = "";
$bd = "asesorias";

function conectar()
    {
        $user = "root";
        $pass = "";
        $server = "localhost";
        $db = "asesorias";
        $con = mysqli_connect($server,$user,$pass,$db) or die("Error al conectar a la base de datos");
        return $con;
    }
?>