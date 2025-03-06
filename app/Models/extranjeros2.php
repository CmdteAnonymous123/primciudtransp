


<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extranjeros2 extends Model
{
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
}