<?php
session_start();
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
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
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="user-name">Hola, <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong></span>
                <a href="dashboard.php"><button class="topbar-btn">Mi Perfil</button></a>
                <a href="logout.php"><button class="topbar-btn">Cerrar Sesión</button></a>
            <?php else: ?>
                <a href="login.php"><button class="topbar-btn">Iniciar Sesión</button></a>
                <a href="register.php"><button class="topbar-btn">Registrarse</button></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container carrito-container">
    <h1 class="carrito-title">🛒 Mi Carrito</h1>
    <?php if (!empty($_SESSION['carrito'])): ?>
    <ul class="carrito-lista">
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $index => $item):
            $total += $item['precio'];
        ?>
            <li class="carrito-item">
                <span><?= htmlspecialchars($item['nombre']) ?></span>
                <span><?= formatCOP($item['precio']) ?></span>
                <a href="remove_from_cart.php?index=<?= $index ?>" class="carrito-remove" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <h2 class="carrito-total">Total: <?= formatCOP($total) ?></h2>
    <div class="carrito-actions">
        <a href="index.php" class="button-carrito">Volver a Comprar</a>
        <!-- Aquí podrías agregar un botón para finalizar compra -->
    </div>
    <?php else: ?>
        <p class="carrito-vacio">El carrito está vacío.</p>
        <div class="carrito-actions">
            <a href="index.php" class="button-carrito">Ir a la tienda</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>