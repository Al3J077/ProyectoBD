<?php
session_start();
include 'functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);
    $confirmar_contrasena = trim($_POST['confirmar_contrasena']);

    if (empty($nombre) || empty($correo) || empty($contrasena) || empty($confirmar_contrasena)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($contrasena !== $confirmar_contrasena) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        if ($stmt->rowCount() > 0) {
            $error = "Este correo ya está registrado.";
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $correo, $hash]);
            $_SESSION['mensaje'] = "Registro exitoso. Ahora puedes iniciar sesión.";
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Barra superior de usuario -->
<div class="topbar">
    <div class="topbar-content">
        <div class="logo">
            <a href="index.php" style="color: #fff; text-decoration: none; font-weight: bold;">ZapasCOL</a>
        </div>
        <div class="user-actions">
            <a href="login.php"><button class="topbar-btn">Iniciar Sesión</button></a>
            <a href="register.php"><button class="topbar-btn">Registrarse</button></a>
        </div>
    </div>
</div>

<div class="container">
    <h2 style="text-align:center; color:#b80000;">Registrarse</h2>
    <?php if (!empty($error)): ?>
        <p style="color:#b80000; text-align:center;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <label for="confirmar_contrasena">Confirmar Contraseña:</label>
        <input type="password" name="confirmar_contrasena" required>

        <button type="submit" class="topbar-btn" style="width:100%;">Registrarse</button>
    </form>
    <p style="text-align:center; margin-top:15px;">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</div>
</body>
</html>