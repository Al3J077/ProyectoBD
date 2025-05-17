<?php
session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];

        // Obtener información del producto
            $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
                $stmt->execute([$id_producto]);
                    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($producto) {
                                $item = [
                                            'id' => $producto['id'],
                                                        'nombre' => $producto['nombre'],
                                                                    'precio' => $producto['precio']
                                                                            ];

                                                                                    $_SESSION['carrito'][] = $item;
                                                                                        }

                                                                                            header('Location: index.php');
                                                                                                exit();
                                                                                                }
                                                                                                ?>