<?php
include("conexion.php");
session_start();

if (isset($_POST['btnLogin'])) {
    $correo = $_POST['correo'];
    $pass = $_POST['contrasena'];

    $query = "SELECT * FROM estudiantes WHERE correo='$correo' AND contrasena='$pass'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $_SESSION['id_estudiante'] = $fila['id_estudiante'];
        $_SESSION['nombre'] = $fila['nombre'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Collar GPS</title>
</head>
<body>
  <h2>Iniciar Sesión</h2>
  <form method="POST">
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit" name="btnLogin">Entrar</button>
  </form>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
