<?php
include 'functions.php';

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
    <div class="productos">
        <?php foreach ($productos as $producto): ?>
            <div class="producto">
                <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
                <p>$<?= number_format($producto['precio'], 2) ?></p>
                <form action="add_to_cart.php" method="post">
                    <!-- 👇 Esta es la línea que debe estar corregida 👇 -->
                    <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                    <button type="submit">Agregar al Carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <a href="cart.php">Ver Carrito</a>
</body>
</html>