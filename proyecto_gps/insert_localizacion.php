<?php
include("conexion.php");

if (isset($_POST['id_animal']) && isset($_POST['latitud']) && isset($_POST['longitud'])) {
    $id_animal = $_POST['id_animal'];
    $lat = $_POST['latitud'];
    $lon = $_POST['longitud'];

    $query = "INSERT INTO localizaciones (id_animal, latitud, longitud) VALUES ('$id_animal','$lat','$lon')";
    if (mysqli_query($conexion, $query)) {
        echo "OK";
    } else {
        echo "ERROR: " . mysqli_error($conexion);
    }
} else {
    echo "FALTAN DATOS";
}
?>
