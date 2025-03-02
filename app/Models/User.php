<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

use Illuminate\Support\Facades\Hash;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: "string", length: 191)]
    private string $username;

    #[ORM\Column(type: "string", length: 191)]
    private string $name;

    #[ORM\Column(type: "string", length: 191, nullable: true)]
    private ?string $email;
    
    #[ORM\Column(type: "string", length: 191, nullable: true)]
    private ?string $password;    

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private string $cedula;

    #[ORM\Column(type: "date", nullable: true)]
    private ?DateTime $fecha_nac;

    #[ORM\Column(type: "string", length: 2, nullable: true)]
    private ?string $lugar_emision;

    #[ORM\ManyToOne(targetEntity: Partido::class)]
    #[ORM\JoinColumn(name: "id_partido", referencedColumnName: "id_partido", nullable: true)]
    private ?Partido $partido;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */    
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'id_partido',
        'cedula',
        'fecha_nac',
        'lugar_emision'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nac' => 'date'
    ];

    // Getters y Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    
    
    
    
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;              
    }    
    
    
    
    

    public function getCedula(): string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): void
    {
        $this->cedula = $cedula;
    }

    public function getFechaNac(): ?DateTime
    {
        return $this->fecha_nac;
    }

    public function setFechaNac(?DateTime $fecha_nac): void
    {
        $this->fecha_nac = $fecha_nac;
    }

    public function getLugarEmision(): ?string
    {
        return $this->lugar_emision;
    }

    public function setLugarEmision(?string $lugar_emision): void
    {
        $this->lugar_emision = $lugar_emision;
    }

    public function getPartido(): ?Partido
    {
        return $this->partido;
    }

    public function setPartido(?Partido $partido): void
    {
        $this->partido = $partido;
    }
}
