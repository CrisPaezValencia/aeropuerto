<?php
require_once __DIR__ . '/database/Connection.php';

use Database\Connection;

try {
    $pdo = Connection::getInstance();

    $stmt = $pdo->query("SELECT id, nombre, rol FROM usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($usuarios) {
        echo "<h2>Lista de usuarios:</h2><ul>";
        foreach ($usuarios as $u) {
            echo "<li>ID: {$u['id']} - Nombre: {$u['nombre']} - Rol: {$u['rol']}</li>";
        }
        echo "</ul>";
    } else {
        echo "⚠️ No hay usuarios en la tabla.";
    }
} catch (PDOException $e) {
    echo "❌ Error en la consulta: " . $e->getMessage();
}
