<?php

// app/Models/Votacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    protected $table = 'votacion';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'fecha_hora', 
        'ubicacion', 
        'ip_origen', 
        'id_eleccion', 
        'id', 
        'id_candidato'
    ];
    
    protected $dates = ['fecha_hora'];
    
    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class, 'id_eleccion', 'id_eleccion');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    
    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'id_candidato', 'id_candidato');
    }
}
