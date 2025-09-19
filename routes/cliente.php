<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Http\Controllers\DashboardController;

$usuarioId = $_GET['id'] ?? null;

if ($usuarioId) {
    $controller = new DashboardController();
    $controller->cliente($usuarioId);
} else {
    echo "Falta el parámetro id";
}
