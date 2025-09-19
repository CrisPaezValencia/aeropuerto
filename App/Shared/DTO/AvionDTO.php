<?php

namespace App\Shared\DTO;

class AvionDTO
{
    public function __construct(
        public ?int $id,
        public string $modelo,
        public int $capacidad
    ) {}
}
