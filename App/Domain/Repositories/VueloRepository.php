<?php

namespace App\Domain\Repositories;

use App\Shared\DTO\VueloDTO;

interface VueloRepository
{
    public function findByCliente(int $usuarioId): array;
    public function findByPiloto(int $usuarioId): array;
    public function findAll(): array;
}
