<?php
require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
use App\Infrastructure\Http\Controllers\UsuarioController;

$controller = new UsuarioController();
$controller->login();
