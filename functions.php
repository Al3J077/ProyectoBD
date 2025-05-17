<?php
// functions.php

$host = 'localhost';
$dbname = 'tienda_zapatos';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
        }
        ?>