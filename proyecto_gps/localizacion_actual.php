<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_estudiante'])) {
    header("Location: index.php");
    exit;
}

$id_estudiante = $_SESSION['id_estudiante'];

$query = "SELECT a.nombre AS animal, l.latitud, l.longitud
          FROM localizaciones l
          INNER JOIN animales a ON l.id_animal = a.id_animal
          WHERE a.id_estudiante = '$id_estudiante'
          ORDER BY l.fecha_hora DESC LIMIT 1";

$result = mysqli_query($conexion, $query);
$ubicacion = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ubicación Actual</title>
</head>
<body>
  <h2>Ubicación actual de tu animal</h2>
  <?php if($ubicacion) { ?>
    <p><strong>Animal:</strong> <?= $ubicacion['animal'] ?></p>
    <p><strong>Latitud:</strong> <?= $ubicacion['latitud'] ?></p>
    <p><strong>Longitud:</strong> <?= $ubicacion['longitud'] ?></p>
    <a href="https://www.google.com/maps?q=<?= $ubicacion['latitud'] ?>,<?= $ubicacion['longitud'] ?>" target="_blank">
        Ver en Google Maps
    </a>
  <?php } else { ?>
    <p>No hay localización registrada aún.</p>
  <?php } ?>
</body>
</html>
