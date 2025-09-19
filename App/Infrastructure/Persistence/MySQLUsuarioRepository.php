<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\UsuarioRepository;
use App\Shared\DTO\UsuarioDTO;
use App\Shared\DTO\VueloDTO;
use PDO;
use PDOException;
use Exception;

class MySQLUsuarioRepository implements UsuarioRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(UsuarioDTO $usuario): void
    {
        if ($usuario->id === null) {
            $stmt = $this->db->prepare("INSERT INTO usuario (nombre, clave, rol) VALUES (?, ?, ?)");
            $stmt->execute([$usuario->nombre, $usuario->clave, $usuario->rol]);
        } else {
            $stmt = $this->db->prepare("UPDATE usuario SET nombre=?, clave=?, rol=? WHERE id=?");
            $stmt->execute([$usuario->nombre, $usuario->clave, $usuario->rol, $usuario->id]);
        }
    }

    public function findById(int $id): ?UsuarioDTO
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE id=?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new UsuarioDTO($data['id'], $data['clave'], $data['nombre'], $data['rol']) : null;
    }

    public function findByNombre(string $nombre): ?UsuarioDTO
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE nombre=?");
        $stmt->execute([$nombre]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new UsuarioDTO($data['id'], $data['clave'], $data['nombre'], $data['rol']) : null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM usuario");
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new UsuarioDTO($row['id'], $row['clave'], $row['nombre'], $row['rol']);
        }
        return $usuarios;
    }

    public function delete(int $id): bool
    {
        try {
            // 1. Eliminar vuelos de clientes de este usuario
            $stmt = $this->db->prepare(
                "DELETE v FROM vuelo v 
             INNER JOIN cliente c ON v.clienteId = c.id 
             WHERE c.usuarioId = :id"
            );
            $stmt->execute(['id' => $id]);

            // 2. Eliminar clientes asociados
            $stmt = $this->db->prepare("DELETE FROM cliente WHERE usuarioId = :id");
            $stmt->execute(['id' => $id]);

            // 3. Eliminar usuario
            $stmt = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
            $stmt->execute(['id' => $id]);

            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            throw new \Exception("Error eliminando usuario: " . $e->getMessage());
        }
    }




    public function findByNombreAndClave(string $nombre, string $clave): ?UsuarioDTO
    {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE nombre=? AND clave=?");
        $stmt->execute([$nombre, $clave]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new UsuarioDTO($data['id'], $data['clave'], $data['nombre'], $data['rol']) : null;
    }

    public function update(UsuarioDTO $usuario)
    {
        $stmt = $this->db->prepare("UPDATE usuario SET nombre = ?, rol = ? WHERE id = ?");
        return $stmt->execute([
            $usuario->nombre,
            $usuario->rol,
            $usuario->id
        ]);
    }
}
