<?php

namespace App\Shared\DTO;

class ClienteDTO
{
    public function __construct(
        public ?int $id,
        public int $usuarioId,
        public string $email,
        public string $telefono
    ) {}
}
