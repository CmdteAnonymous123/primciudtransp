<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "partido")]
class partido extends Model
{
    use HasFactory;
    
    protected $table = 'partido';
    protected $primaryKey = 'id_partido';
    public $timestamps = false;     
    

    #[ORM\Id]
    #[ORM\Column(type: "smallint", options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    private int $id_partido;

    #[ORM\Column(type: "string", length: 255)]
    private string $sigla;

    #[ORM\Column(type: "string", length: 255)]
    private string $nombre;

    // Getters y Setters
    public function getIdPartido(): int
    {
        return $this->id_partido;
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): void
    {
        $this->sigla = $sigla;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
}
