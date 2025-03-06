<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ORM\Entity]
#[ORM\Table(name: "candidato")]
class candidato extends Model
{
    use HasFactory;

    protected $table = 'candidato';
    protected $primaryKey = 'id_candidato';
    public $timestamps = false;

    #[ORM\Id]
    #[ORM\Column(type: "smallint", options: ["unsigned" => true])]
    #[ORM\GeneratedValue]
    protected $id_candidato;

    #[ORM\Column(type: "string", length: 255)]
    protected $nombres;    
    
    public function getId_candidato() {
        return $this->id_candidato;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setId_candidato($id_candidato): void {
        $this->id_candidato = $id_candidato;
    }

    public function setNombres($nombres): void {
        $this->nombres = $nombres;
    }

    #[ORM\ManyToOne(targetEntity: "App\\Models\\Partido")]
    #[ORM\JoinColumn(name: "id_partido", referencedColumnName: "id_partido", onDelete: "CASCADE", onUpdate: "CASCADE")]
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'id_partido', 'id_partido');
    }

    #[ORM\OneToMany(targetEntity: "App\\Models\\Resultado", mappedBy: "candidato")]
    public function resultados()
    {
        return $this->hasMany(Resultado::class, 'id_candidato', 'id_candidato');
    }
}
