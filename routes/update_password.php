<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Conexión a la BD (ajusta según tu config)
$pdo = new PDO("mysql:host=localhost;dbname=aeropuerto", "root", "sandbox");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $nuevaClave = $_POST['clave'] ?? '';

    if (!empty($nombre) && !empty($nuevaClave)) {
        // 1. Obtener la clave actual del usuario
        $stmt = $pdo->prepare("SELECT clave FROM usuario WHERE nombre = :nombre");
        $stmt->execute(['nombre' => $nombre]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $claveActual = $usuario['clave'];

            // 2. Validar si la nueva clave es igual a la actual
            if ($claveActual === $nuevaClave) {
                echo "<script>alert('⚠️ La nueva contraseña no puede ser igual a la actual.'); window.history.back();</script>";
                exit;
            }

            // 3. Actualizar la contraseña
            $update = $pdo->prepare("UPDATE usuario SET clave = :clave WHERE nombre = :nombre");
            $update->execute([
                'clave' => $nuevaClave,
                'nombre' => $nombre
            ]);

            echo "<script>alert('✅ Contraseña actualizada con éxito.'); window.location.href='../index.html';</script>";
            exit;
        } else {
            echo "<script>alert('❌ Usuario no encontrado.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Por favor completa todos los campos.'); window.history.back();</script>";
    }
}
