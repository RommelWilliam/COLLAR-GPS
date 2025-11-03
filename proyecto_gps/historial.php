<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_estudiante'])) {
    header("Location: index.php");
    exit;
}

$id_estudiante = $_SESSION['id_estudiante'];
$query = "SELECT a.nombre AS animal, l.latitud, l.longitud, l.fecha_hora
          FROM localizaciones l
          INNER JOIN animales a ON l.id_animal = a.id_animal
          WHERE a.id_estudiante = '$id_estudiante'
          ORDER BY l.fecha_hora DESC";
$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de Localizaciones</title>
</head>
<body>
  <h2>Historial de localizaciones</h2>
  <table border="1">
    <tr>
      <th>Animal</th>
      <th>Latitud</th>
      <th>Longitud</th>
      <th>Fecha y Hora</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $row['animal'] ?></td>
      <td><?= $row['latitud'] ?></td>
      <td><?= $row['longitud'] ?></td>
      <td><?= $row['fecha_hora'] ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
