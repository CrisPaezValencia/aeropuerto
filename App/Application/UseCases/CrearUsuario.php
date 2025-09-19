<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UsuarioRepository;
use App\Shared\DTO\UsuarioDTO;

class CrearUsuario
{
    private UsuarioRepository $repo;

    public function __construct(UsuarioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execute(string $nombre, string $clave, string $rol): void
    {
        $usuario = new UsuarioDTO(
            null,
            $clave,
            $nombre,
            $rol
        );

        $this->repo->save($usuario);
    }
}
