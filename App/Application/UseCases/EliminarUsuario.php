<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UsuarioRepository;

class EliminarUsuario
{
    private $usuarioRepo;

    public function __construct(UsuarioRepository $usuarioRepo)
    {
        $this->usuarioRepo = $usuarioRepo;
    }

    public function execute($id)
    {
        $usuario = $this->usuarioRepo->findById($id);
        if (!$usuario) {
            throw new \Exception("Usuario no encontrado");
        }

        $ok = $this->usuarioRepo->delete($id);

        if (!$ok) {
            throw new \Exception("No se pudo eliminar el usuario con ID $id");
        }
    }
}
