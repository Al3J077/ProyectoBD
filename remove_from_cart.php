<?php
session_start();

if (isset($_GET['index'])) {
    $index = intval($_GET['index']);

    // Verifica que el índice exista en el carrito
    if (isset($_SESSION['carrito'][$index])) {
        // Elimina el producto del carrito
        unset($_SESSION['carrito'][$index]);

        // Reindexar el array para evitar huecos
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

// Redirige al carrito
header('Location: cart.php');
exit();