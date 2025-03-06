<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "votacion")]
class votacion extends Model
{
    use HasFactory;

    #[ORM\Column(type: "datetime")]
    private \DateTime $fecha_hora;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $ubicacion;

    #[ORM\Column(type: "string", length: 45, nullable: true)]
    private ?string $ip_origen;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "Eleccion")]
    #[ORM\JoinColumn(name: "id_eleccion", referencedColumnName: "id_eleccion", onUpdate: "CASCADE")]
    private Eleccion $eleccion;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "id", referencedColumnName: "id", onUpdate: "CASCADE")]
    private User $user;

    #[ORM\ManyToOne(targetEntity: "Candidato")]
    #[ORM\JoinColumn(name: "id_candidato", referencedColumnName: "id_candidato", nullable: true, onUpdate: "CASCADE")]
    private ?Candidato $candidato;

    // Getters y Setters
    public function getFechaHora(): \DateTime
    {
        return $this->fecha_hora;
    }

    public function setFechaHora(\DateTime $fecha_hora): self
    {
        $this->fecha_hora = $fecha_hora;
        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;
        return $this;
    }

    public function getIpOrigen(): ?string
    {
        return $this->ip_origen;
    }

    public function setIpOrigen(?string $ip_origen): self
    {
        $this->ip_origen = $ip_origen;
        return $this;
    }

    public function getEleccion(): Eleccion
    {
        return $this->eleccion;
    }

    public function setEleccion(Eleccion $eleccion): self
    {
        $this->eleccion = $eleccion;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getCandidato(): ?Candidato
    {
        return $this->candidato;
    }

    public function setCandidato(?Candidato $candidato): self
    {
        $this->candidato = $candidato;
        return $this;
    }
}
