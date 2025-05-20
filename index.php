<?php 
session_start();
include 'functions.php';

// Obtener productos desde la base de datos
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Zapatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Zapatos Disponibles</h1>

<!-- Mostrar los productos -->
<div class="productos">
    <?php foreach ($productos as $producto): ?>
        <div class="producto">
            <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
            <p><?= formatCOP($producto['precio']) ?></p>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                <button type="submit">Agregar al Carrito</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<br>
<a href="cart.php"><button>Ver Carrito</button></a>

<!-- Mostrar información del usuario -->
<?php if (isset($_SESSION['usuario'])): ?>
    <div style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
        <p><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($_SESSION['usuario']['correo']) ?></p>
        <p><strong>Rol:</strong> <?= ucfirst($_SESSION['usuario']['rol']) ?></p>
        <a href="dashboard.php"><button>Mi Perfil</button></a>
        <a href="logout.php"><button>Cerrar Sesión</button></a>
    </div>
<?php else: ?>
    <div style="margin-top: 30px;">
        <a href="login.php"><button>Iniciar Sesión</button></a>
        <a href="register.php"><button>Registrarse</button></a>
    </div>
<?php endif; ?>

</body>
</html>