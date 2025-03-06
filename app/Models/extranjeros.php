<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

use DateTime;



 #[ORM\Entity]
 #[ORM\Table(name: "extranjeros")]
class Extranjeros extends Model
{ 
    use HasFactory;

   // Nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'extranjeros';

    // Nombre de la clave primaria si no es 'id'
    protected $primaryKey = 'id_extranjeros';

    // Tipos de datos de los atributos
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'votos' => 'integer'
    ];

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'pais', 
        'votos', 
        'created_at', 
        'updated_at'
    ];

    // Si no quieres usar created_at y updated_at
    public $timestamps = true;    
    

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "bigint", options:["unsigned" => true])]
    private $id_extranjeros;

   #[ORM\Column(type: "integer", options:["unsigned" => true, "default" => 0])]
    private $votos;

    #[ORM\Column(type:"string", length: 255)]
    private $pais;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $created_at;

     #[ORM\Column(type: "datetime", nullable: true)]
    private $updated_at;

    // Getters y Setters
    public function getIdExtranjeros(): ?int
    {
        return $this->id_extranjeros;
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

    public function getPais(): string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;
        return $this;
    }

    public function getCreatedAtCustom(): ?DateTime 
    {
        return $this->created_at;
    }

    
    public function getUpdatedAtCustom(): ?DateTime {
        return $this->updated_at;
    }

    public function setCreatedAtCustom(?DateTime $created_at): self {
        $this->created_at = $created_at;
        return $this;
    }

    public function setUpdatedAtCustom(?DateTime $updated_at): self {
        $this->updated_at = $updated_at;
        return $this;
    }
        
}
