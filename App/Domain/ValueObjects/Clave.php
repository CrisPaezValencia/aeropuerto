<?php

namespace App\Domain\ValueObjects;

class Clave
{
    private string $hash;

    public function __construct(string $clavePlano)
    {
        $this->hash = password_hash($clavePlano, PASSWORD_BCRYPT);
    }

    public function verificar(string $clavePlano): bool
    {
        return password_verify($clavePlano, $this->hash);
    }

    public function __toString(): string
    {
        return $this->hash;
    }
}
