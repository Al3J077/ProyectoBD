<?php
session_start();
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Mi Carrito</h1>
    <?php if (!empty($_SESSION['carrito'])): ?>
    <ul>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $index => $item):
            $total += $item['precio'];
        ?>
            <li>
                <?= htmlspecialchars($item['nombre']) ?> - 
                <?= formatCOP($item['precio']) ?>
                <a href="remove_from_cart.php?index=<?= $index ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <h2>Total: <?= formatCOP($total) ?></h2>
    <a href="index.php"><button>Volver a Comprar</button></a>
<?php else: ?>
    <p>El carrito está vacío.</p>
<?php endif; ?>
</body>
</html>