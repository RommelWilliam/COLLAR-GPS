<?php
$conexion = mysqli_connect("localhost", "root", "", "db_collar_gps");

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>