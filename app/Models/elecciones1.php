<?php

// app/Models/Eleccion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    protected $table = 'eleccion';
    protected $primaryKey = 'id_eleccion';
    public $timestamps = false;
    
    protected $fillable = ['nombre', 'fecha_ini', 'fecha_fin'];
    
    protected $dates = ['fecha_ini', 'fecha_fin'];
    
    public function candidatos()
    {
        return $this->belongsToMany(
            Candidato::class, 
            'eleccion_candidato', 
            'id_eleccion', 
            'id_candidato'
        );
    }
    
    public function votaciones()
    {
        return $this->hasMany(Votacion::class, 'id_eleccion', 'id_eleccion');
    }
}