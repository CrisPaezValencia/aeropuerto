<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Http\Controllers\UsuarioController;

$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $clave  = $_POST['clave'] ?? '';
    $rol    = $_POST['rol'] ?? '';

    if ($nombre && $clave && $rol) {
        $controller->crear($nombre, $clave, $rol);
    } else {
        echo "⚠️ Todos los campos son obligatorios.";
    }
}
