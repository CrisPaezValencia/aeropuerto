<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UsuarioRepository;

class EditarUsuario
{
    private $usuarioRepo;

    public function __construct(UsuarioRepository $usuarioRepo)
    {
        $this->usuarioRepo = $usuarioRepo;
    }

    public function execute($id, $nombre, $rol)
    {
        $usuario = $this->usuarioRepo->findById($id);
        if (!$usuario) {
            throw new \Exception("Usuario no encontrado");
        }

        $usuario->setNombre($nombre);
        $usuario->setRol($rol);

        $this->usuarioRepo->update($usuario);
    }
}
