<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\ListarUsuarios;
use App\Application\UseCases\ListarVuelosDePiloto;
use App\Application\UseCases\ListarVuelosDeCliente;
use App\Infrastructure\Persistence\MySQLUsuarioRepository;
use App\Infrastructure\Persistence\MySQLVueloRepository;
use App\Application\UseCases\ListarVuelos;
use PDO;

class DashboardController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=aeropuerto", "root", "sandbox");
    }

    public function admin()
    {
        // Usuarios
        $usuarioRepo = new MySQLUsuarioRepository($this->db);
        $listarUsuarios = new ListarUsuarios($usuarioRepo);
        $usuarios = $listarUsuarios->execute();

        // Vuelos
        $vueloRepo = new MySQLVueloRepository($this->db);
        $listarVuelos = new ListarVuelos($vueloRepo);
        $vuelos = $listarVuelos->execute();


        require dirname(__DIR__, 4) . '/views/admin_dashboard.php';
    }

    public function piloto($usuarioId)
    {
        $repo = new MySQLVueloRepository($this->db);
        $useCase = new ListarVuelosDePiloto($repo);
        $vuelos = $useCase->execute($usuarioId);

        require dirname(__DIR__, 4) . '/views/piloto_dashboard.php';
    }

    public function cliente($usuarioId)
    {
        $repo = new MySQLVueloRepository($this->db);
        $useCase = new ListarVuelosDeCliente($repo);
        $vuelos = $useCase->execute($usuarioId);

        require dirname(__DIR__, 4) . '/views/cliente_dashboard.php';
    }
}
