<?php
session_start();

if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Http\Controllers\UsuarioController;

$controller = new UsuarioController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $controller->eliminar((int)$_GET['id']);
    header("Location: admin.php");
    exit;
} else {
    echo "ID inválido para eliminar usuario.";
}
