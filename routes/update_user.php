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
    $controller->editar($_POST['id'], $_POST['nombre'], $_POST['rol']);
}
