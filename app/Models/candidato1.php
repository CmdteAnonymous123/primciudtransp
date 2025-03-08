<?php
// app/Models/Candidato.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidato';
    protected $primaryKey = 'id_candidato';
    public $timestamps = false;
    
    protected $fillable = ['nombres', 'id_partido'];
    
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'id_partido', 'id_partido');
    }
    
    public function elecciones()
    {
        return $this->belongsToMany(
            Eleccion::class, 
            'eleccion_candidato', 
            'id_candidato', 
            'id_eleccion'
        );
    }
    
    public function votaciones()
    {
        return $this->hasMany(Votacion::class, 'id_candidato', 'id_candidato');
    }
}


