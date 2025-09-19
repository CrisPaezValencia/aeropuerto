<?php
require_once __DIR__ . "/database/Connection.php";

use Database\Connection;

try {
    $db = Connection::getInstance();
    echo "✅ Conexión exitosa a MySQL<br>";

    // Opcional: probar con una consulta
    $stmt = $db->query("SELECT NOW() AS fecha_actual");
    $row = $stmt->fetch();
    echo "Fecha desde MySQL: " . $row['fecha_actual'];
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
