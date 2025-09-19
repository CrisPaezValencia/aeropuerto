<?php

namespace App\Domain\Repositories;

use App\Shared\DTO\UsuarioDTO;

interface UsuarioRepository
{
    public function save(UsuarioDTO $usuario): void;
    public function findById(int $id): ?UsuarioDTO;
    public function findByNombre(string $nombre): ?UsuarioDTO;
    public function findAll(): array;
    public function delete(int $id): bool;
    public function update(UsuarioDTO $usuario);
}
