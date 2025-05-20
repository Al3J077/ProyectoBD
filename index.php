<?php
session_start();
include 'functions.php';

// Si se realiza una búsqueda, preparamos la consulta con LIKE en nombre y descripción.
if (isset($_GET['buscar']) && !empty(trim($_GET['buscar']))) {
    $busqueda = '%' . trim($_GET['buscar']) . '%';
    $stmt = $pdo->prepare("SELECT p.*, c.nombre_categoria 
        FROM productos p 
        JOIN categorias c ON p.id_categoria = c.id_categoria 
        WHERE p.nombre LIKE ? OR p.descripcion LIKE ?");
    $stmt->execute([$busqueda, $busqueda]);
} else {
    $stmt = $pdo->query("SELECT p.*, c.nombre_categoria 
        FROM productos p 
        JOIN categorias c ON p.id_categoria = c.id_categoria");
}
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Zapatos</title>
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
                <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
                    <a href="admin.php"><button class="topbar-btn">Panel Admin</button></a>
                <?php endif; ?>
                <a href="logout.php"><button class="topbar-btn">Cerrar Sesión</button></a>
            <?php else: ?>
                <a href="login.php"><button class="topbar-btn">Iniciar Sesión</button></a>
                <a href="register.php"><button class="topbar-btn">Registrarse</button></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<h1>Bienvenido a ZapasCOL</h1>
<h2>Escoge tus zapatos preferidos!</h2>

<!-- Barra de búsqueda -->
<div class="search-container">
    <form action="index.php" method="GET">
        <input type="text" name="buscar" placeholder="Buscar productos..." class="search-input">
        <button type="submit" class="search-btn">🔍</button>
    </form>
</div>

<!-- Mostrar los productos -->
<div class="productos">
    <?php foreach ($productos as $producto): ?>
        <div class="producto">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="img/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" class="producto-img">
            <?php else: ?>
                <img src="img/default.jpg" alt="Sin imagen" class="producto-img">
            <?php endif; ?>
            <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
            <p class="categoria-producto">Categoría: <?= htmlspecialchars($producto['nombre_categoria']) ?></p>
            <p class="precio-zapatilla"><?= formatCOP($producto['precio']) ?></p>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                <button type="submit">Agregar al Carrito</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<br>
<div class="ver-carrito-container">
    <a href="cart.php" class="ver-carrito-btn">
        <span class="carrito-icono">🛒</span> Ver Carrito
        <?php if (!empty($_SESSION['carrito'])): ?>
            <span class="carrito-cantidad"><?= count($_SESSION['carrito']) ?></span>
        <?php endif; ?>
    </a>
</div>

</body>
</html>