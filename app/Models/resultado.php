<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @ORM\Entity
 * @ORM\Table(name="resultado")
 */
class resultado extends Model
{
    use HasFactory;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint", options={"unsigned": true})
     */
    private $id_resultado;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $votos;

    /**
     * @ORM\Column(type="smallint", options={"unsigned": true})
     */
    private $id_eleccion;

    /**
     * @ORM\Column(type="smallint", options={"unsigned": true})
     */
    private $id_candidato;

    /**
     * @ORM\ManyToOne(targetEntity="Eleccion")
     * @ORM\JoinColumn(name="id_eleccion", referencedColumnName="id_eleccion", onUpdate="CASCADE")
     */
    private $eleccion;

    /**
     * @ORM\ManyToOne(targetEntity="Candidato")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id_candidato", onUpdate="CASCADE")
     */
    private $candidato;

    // Getters y Setters
    public function getIdResultado(): ?int
    {
        return $this->id_resultado;
    }

    public function getVotos(): int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): self
    {
        $this->votos = $votos;
        return $this;
    }

    public function getIdEleccion(): int
    {
        return $this->id_eleccion;
    }

    public function setIdEleccion(int $id_eleccion): self
    {
        $this->id_eleccion = $id_eleccion;
        return $this;
    }

    public function getIdCandidato(): int
    {
        return $this->id_candidato;
    }

    public function setIdCandidato(int $id_candidato): self
    {
        $this->id_candidato = $id_candidato;
        return $this;
    }
}
