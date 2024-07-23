<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_orden', 'id_paciente', 'modalidad', 'nombre_estudio', 'id_imagen'
    ];

    public function readings()
    {
        return $this->hasMany(Reading::class, 'id_orden', 'id_orden');
    }
}
