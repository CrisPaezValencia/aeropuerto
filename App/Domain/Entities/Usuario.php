<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Clave;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Rol;

class Usuario
{
    private ?int $id;
    private string $nombre;
    private Clave $clave;
    private Email $email;
    private Rol $rol;

    public function __construct(?int $id, string $nombre, Clave $clave, Email $email, Rol $rol)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
        $this->rol = $rol;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getClave(): Clave
    {
        return $this->clave;
    }
    public function getEmail(): Email
    {
        return $this->email;
    }
    public function getRol(): Rol
    {
        return $this->rol;
    }

    public function cambiarClave(Clave $nuevaClave): void
    {
        $this->clave = $nuevaClave;
    }
}
