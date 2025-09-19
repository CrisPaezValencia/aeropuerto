<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Http\Controllers\DashboardController;

session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: /login.php");
    exit;
}

$controller = new DashboardController();
$controller->admin();
