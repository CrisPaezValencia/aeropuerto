<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\VueloRepository;

class ListarVuelosDePiloto
{
    private VueloRepository $vuelos;

    public function __construct(VueloRepository $vuelos)
    {
        $this->vuelos = $vuelos;
    }

    public function execute(int $usuarioId): array
    {
        return $this->vuelos->findByPiloto($usuarioId);
    }
}
