<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "eleccion")]
class eleccion extends Model
{
    use HasFactory;

    #[ORM\Id]
    #[ORM\Column(type: "smallint", options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int $id_eleccion;

    #[ORM\Column(type: "string", length: 255)]
    private string $nombre;

    #[ORM\Column(type: "date")]
    private \DateTime $fecha_ini;

    #[ORM\Column(type: "date")]
    private \DateTime $fecha_fin;

    // Getters y Setters
    public function getIdEleccion(): int
    {
        return $this->id_eleccion;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getFechaIni(): \DateTime
    {
        return $this->fecha_ini;
    }

    public function setFechaIni(\DateTime $fecha_ini): void
    {
        $this->fecha_ini = $fecha_ini;
    }

    public function getFechaFin(): \DateTime
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTime $fecha_fin): void
    {
        $this->fecha_fin = $fecha_fin;
    }
}
