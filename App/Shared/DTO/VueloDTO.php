<?php

namespace App\Shared\DTO;

class VueloDTO
{

    private ?int $id;
    private string $fechaCompra;
    private string $fechaSalida;
    private string $fechaLlegada;
    private string $agenciaViajes;
    private string $aerolinea;
    private string $numero;
    private string $estado;
    private float $valor;
    private int $clienteId;
    private string $puesto;
    private int $avionId;
    private int $aeropuertoSalidaId;
    private int $aeropuertoLlegadaId;
    private int $pilotoId;

    public function __construct(
        ?int $id,
        string $fechaCompra,
        string $fechaSalida,
        string $fechaLlegada,
        string $agenciaViajes,
        string $aerolinea,
        string $numero,
        string $estado,
        float $valor,
        int $clienteId,
        string $puesto,
        int $avionId,
        int $aeropuertoSalidaId,
        int $aeropuertoLlegadaId,
        int $pilotoId
    ) {
        $this->id = $id;
        $this->fechaCompra = $fechaCompra;
        $this->fechaSalida = $fechaSalida;
        $this->fechaLlegada = $fechaLlegada;
        $this->agenciaViajes = $agenciaViajes;
        $this->aerolinea = $aerolinea;
        $this->numero = $numero;
        $this->estado = $estado;
        $this->valor = $valor;
        $this->clienteId = $clienteId;
        $this->puesto = $puesto;
        $this->avionId = $avionId;
        $this->aeropuertoSalidaId = $aeropuertoSalidaId;
        $this->aeropuertoLlegadaId = $aeropuertoLlegadaId;
        $this->pilotoId = $pilotoId;
    }

    // 👇 GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNumero(): string
    {
        return $this->numero;
    }
    public function getAerolinea(): string
    {
        return $this->aerolinea;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }

    // extra si después los usas en cliente/piloto
    public function getFechaSalida(): string
    {
        return $this->fechaSalida;
    }
    public function getFechaLlegada(): string
    {
        return $this->fechaLlegada;
    }
    public function getValor(): float
    {
        return $this->valor;
    }
    public function getPuesto(): string
    {
        return $this->puesto;
    }
    public function getClienteId(): int
    {
        return $this->clienteId;
    }
    public function getPilotoId(): int
    {
        return $this->pilotoId;
    }

    public function getAvionId(): int
    {
        return $this->avionId;
    }
    public function getAeropuertoSalidaId(): int
    {
        return $this->aeropuertoSalidaId;
    }

    public function getAeropuertoLlegadaId(): int
    {
        return $this->aeropuertoLlegadaId;
    }

    public function getFechaCompra(): string
    {
        return $this->fechaCompra;
    }

    public function getAgenciaViajes(): string
    {
        return $this->agenciaViajes;
    }
}
