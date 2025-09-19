<?php

namespace App\Shared\DTO;

class UsuarioDTO
{
    public ?int $id;
    public string $nombre;
    public string $clave;
    public string $rol;

    public function __construct(?int $id, string $clave, string $nombre, string $rol)
    {
        $this->id = $id;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->rol = $rol;
    }
    // 👇 GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    // 👇 SETTERS

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setClave(string $clave): void
    {
        $this->clave = $clave;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }
    
}

interface UsuarioRepository
{
    public function save(UsuarioDTO $usuario): void;
    public function findById(int $id): ?UsuarioDTO;
    public function findByNombre(string $nombre): ?UsuarioDTO;
    public function findAll(): array;
    public function delete(int $id): void;
}