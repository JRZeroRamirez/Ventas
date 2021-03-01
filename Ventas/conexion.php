<?php

//datos de  la base de datos 
$user = "root";
$password = "";  
$host = "localhost";
$db= "ventas";

//conexion a al  bd
$conection = @mysqli_connect( $host, $user,$password,$db ) or die ("No se ha podido conectar al servidor de Base de datos");



if(!$conection){
    echo "Error en la conexion";
}
?>