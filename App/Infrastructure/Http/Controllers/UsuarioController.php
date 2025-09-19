<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCases\LoginUser;
use App\Infrastructure\Persistence\MySQLUsuarioRepository;
use App\Application\UseCases\EditarUsuario;
use App\Application\UseCases\EliminarUsuario;
use PDO;

class UsuarioController
{
    private $repo;

    public function __construct()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=aeropuerto", "root", "sandbox");
        $this->repo = new MySQLUsuarioRepository($pdo);
    }

    public function login()
    {
        session_start();

        // 👇 Usamos el repo ya creado en el constructor
        $login = new LoginUser($this->repo);

        $nombre = $_POST['nombre'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $usuario = $login->execute($nombre, $clave);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['rol'] = $usuario->rol;
            $_SESSION['nombre'] = $usuario->nombre;

            // Redirigir según rol
            switch ($usuario->rol) {
                case 'admin':
                    header("Location: /routes/admin.php");
                    break;
                case 'piloto':
                    header("Location: /routes/piloto.php?id={$usuario->id}");
                    break;
                case 'cliente':
                    header("Location: /routes/cliente.php?id={$usuario->id}");
                    break;
            }

            exit;
        } else {
            echo "❌ Usuario o contraseña incorrectos";
        }
    }

    public function editar($id, $nombre, $rol)
    {
        $useCase = new EditarUsuario($this->repo);
        $useCase->execute($id, $nombre, $rol);

        header("Location: /routes/admin.php");
        exit;
    }

    public function eliminar($id)
    {
        $useCase = new EliminarUsuario($this->repo);
        $useCase->execute($id);
        exit;
    }

    public function mostrarFormularioEdicion($id)
    {
        $usuario = $this->repo->findById($id);

        require __DIR__ . '/../../../routes/views/edit_user_form.php';
    }

    public function crear($nombre, $clave, $rol)
    {
        $useCase = new \App\Application\UseCases\CrearUsuario($this->repo);
        $useCase->execute($nombre, $clave, $rol);

        header("Location: /routes/admin.php");
        exit;
    }
}
