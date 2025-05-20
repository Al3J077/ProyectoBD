<?php
session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'correo' => $usuario['correo'],
            'rol' => $usuario['rol']
        ];
        header('Location: index.php');
        exit();
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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
    <h2 style="text-align:center; color:#b80000;">Iniciar Sesión</h2>
    <?php if (!empty($error)) echo "<p style='color:#b80000; text-align:center;'>$error</p>"; ?>
    <form method="post">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit" class="topbar-btn" style="width:100%;">Iniciar Sesión</button>
    </form>
    <p style="text-align:center; margin-top:15px;">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</div>
</body>
</html>