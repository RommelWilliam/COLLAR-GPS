<?php
session_start();
if (!isset($_SESSION['id_estudiante'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel principal</title>
</head>
<body>
  <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
  <ul>
    <li><a href="registrar_animal.php">Registrar Animal</a></li>
    <li><a href="historial.php">Mostrar Historial</a></li>
    <li><a href="localizacion_actual.php">Localización Actual</a></li>
    <li><a href="index.php">Cerrar Sesión</a></li>
  </ul>
</body>
</html>
