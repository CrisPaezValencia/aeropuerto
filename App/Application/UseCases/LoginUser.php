<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UsuarioRepository;
use App\Shared\DTO\UsuarioDTO;

class LoginUser
{
    private UsuarioRepository $usuarios;

    public function __construct(UsuarioRepository $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function execute(string $nombre, string $clave): ?UsuarioDTO
    {
        $usuario = $this->usuarios->findByNombre($nombre);

        if (!$usuario) {
            return null;
        }

        // Comparación simple (sin hash)
        if ($usuario->clave === $clave) {
            return $usuario;
        }

        return null;
    }
}
