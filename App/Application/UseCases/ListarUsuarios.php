<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\UsuarioRepository;

class ListarUsuarios
{
    private UsuarioRepository $usuarios;

    public function __construct(UsuarioRepository $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function execute(): array
    {
        return $this->usuarios->findAll();
    }
}
