<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_estudiante'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['btnGuardar'])) {
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $sexo = $_POST['sexo'];
    $dueno = $_POST['nombre_dueno'];
    $id_estudiante = $_SESSION['id_estudiante'];

    $query = "INSERT INTO animales (id_estudiante, nombre, raza, sexo, nombre_dueno)
              VALUES ('$id_estudiante','$nombre','$raza','$sexo','$dueno')";
    if (mysqli_query($conexion, $query)) {
        $mensaje = "Animal registrado correctamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Animal</title>
</head>
<body>
  <h2>Registrar Animal</h2>
  <form method="POST">
    <input type="text" name="nombre" placeholder="Nombre del animal" required><br>
    <input type="text" name="raza" placeholder="Raza" required><br>
    <input type="text" name="sexo" placeholder="Sexo" required><br>
    <input type="text" name="nombre_dueno" placeholder="Nombre del dueño" required><br>
    <button type="submit" name="btnGuardar">Guardar</button>
  </form>
  <?php if(isset($mensaje)) echo "<p>$mensaje</p>"; ?>
</body>
</html>
