<?php

namespace App\Application\UseCases;

use App\Domain\Repositories\VueloRepository;

class ListarVuelos
{
    private VueloRepository $repo;

    public function __construct(VueloRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execute(): array
    {
        return $this->repo->findAll();
    }
}
