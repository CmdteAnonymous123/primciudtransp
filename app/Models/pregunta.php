<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

/**
* @[ORM\Entity]
* @[ORM\Table(name: "pregunta")]
*/
class pregunta extends Model
{
    use HasFactory;
    
    protected $table = 'pregunta';
    protected $primaryKey = 'id_pregunta'; // Define la clave primaria correctamente    
    
    
    
    /**
    * @[ORM\Id]
    * @[ORM\Column(type: "smallint", unsigned: true)]
    * @[ORM\GeneratedValue]
    */
    private int $id_pregunta;

    /*
    * @[ORM\Column(type: "string", length: 255)]
    */
    private string $enunciado;

    /*
    * @[ORM\Column(type: "string", length: 255)]
    */
    private string $respuesta;

    // Getters y Setters
    public function getIdPregunta(): int
    {
        return $this->id_pregunta;
    }

    public function getEnunciado(): string
    {
        return $this->enunciado;
    }

    public function setEnunciado(string $enunciado): void
    {
        $this->enunciado = $enunciado;
    }

    public function getRespuesta(): string
    {
        return $this->respuesta;
    }

    public function setRespuesta(string $respuesta): void
    {
        $this->respuesta = $respuesta;
    }
}
