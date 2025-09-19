<?php

namespace App\Domain\ValueObjects;

class Rol
{
    private string $value;

    public function __construct(string $rol)
    {
        $rolesPermitidos = ['ADMIN', 'USER'];
        if (!in_array($rol, $rolesPermitidos)) {
            throw new \InvalidArgumentException("Rol inválido");
        }
        $this->value = $rol;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
