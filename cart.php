<?php
session_start();
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
                                                                foreach ($_SESSION['carrito'] as $item):
                                                                                $total += $item['precio'];
                                                                                            ?>
                                                                                                            <li>
                                                                                                                                <?= htmlspecialchars($item['nombre']) ?> - $<?= number_format($item['precio'], 2) ?>
                                                                                                                                                </li>
                                                                                                                                                            <?php endforeach; ?>
                                                                                                                                                                    </ul>
                                                                                                                                                                            <h2>Total: $<?= number_format($total, 2) ?></h2>
                                                                                                                                                                                    <a href="index.php"><button>Volver a Comprar</button></a>
                                                                                                                                                                                        <?php else: ?>
                                                                                                                                                                                                <p>El carrito está vacío.</p>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    </body>
                                                                                                                                                                                                    </html>