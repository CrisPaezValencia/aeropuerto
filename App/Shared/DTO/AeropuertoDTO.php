<?php

namespace App\Shared\DTO;

class AeropuertoDTO
{
    public function __construct(
        public ?int $id,
        public string $nombre,
        public string $ciudad,
        public string $pais
    ) {}
}
