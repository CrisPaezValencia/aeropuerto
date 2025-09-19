<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\VueloRepository;
use App\Shared\DTO\VueloDTO;
use PDO;

class MySQLVueloRepository implements VueloRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByCliente(int $usuarioId): array
    {
        $stmt = $this->db->prepare("SELECT v.* 
                                    FROM vuelo v
                                    INNER JOIN cliente c ON v.clienteId = c.id
                                    WHERE c.usuarioId = ?");
        $stmt->execute([$usuarioId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($r) => new VueloDTO(
            $r['id'] ?? null,
            $r['fechaCompra'],
            $r['fechaSalida'],
            $r['fechaLlegada'],
            $r['agenciaViajes'],
            $r['aerolinea'],
            $r['numero'],
            $r['estado'],
            (float) $r['valor'],
            (int) $r['clienteId'],
            $r['puesto'],
            (int) $r['avionId'],
            (int) $r['aeropuertoSalidaId'],
            (int) $r['aeropuertoLlegadaId'],
            (int) $r['pilotoId']
        ), $rows);
    }

    public function findByPiloto(int $usuarioId): array
    {
        $stmt = $this->db->prepare("SELECT v.* 
                                    FROM vuelo v
                                    INNER JOIN piloto p ON v.pilotoId = p.id
                                    WHERE p.usuarioId = ?");
        $stmt->execute([$usuarioId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($r) => new VueloDTO(
            $r['id'] ?? null,
            $r['fechaCompra'],
            $r['fechaSalida'],
            $r['fechaLlegada'],
            $r['agenciaViajes'],
            $r['aerolinea'],
            $r['numero'],
            $r['estado'],
            (float) $r['valor'],
            (int) $r['clienteId'],
            $r['puesto'],
            (int) $r['avionId'],
            (int) $r['aeropuertoSalidaId'],
            (int) $r['aeropuertoLlegadaId'],
            (int) $r['pilotoId']
        ), $rows);
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM vuelo");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($r) => new VueloDTO(
            $r['id'] ?? null,
            $r['fechaCompra'],
            $r['fechaSalida'],
            $r['fechaLlegada'],
            $r['agenciaViajes'],
            $r['aerolinea'],
            $r['numero'],
            $r['estado'],
            (float) $r['valor'],
            (int) $r['clienteId'],
            $r['puesto'],
            (int) $r['avionId'],
            (int) $r['aeropuertoSalidaId'],
            (int) $r['aeropuertoLlegadaId'],
            (int) $r['pilotoId']
        ), $rows);
    }
}
