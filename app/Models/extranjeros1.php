
<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="extranjeros")
 */
class Extranjeros1
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", options={"unsigned": true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_extranjeros;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true, "default": 0})
     */
    private $votos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pais;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}