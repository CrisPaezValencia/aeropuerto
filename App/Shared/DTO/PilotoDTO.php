<?php

namespace App\Shared\DTO;

class PilotoDTO
{
    public function __construct(
        public ?int $id,
        public int $usuarioId,
        public string $licencia
    ) {}
}
