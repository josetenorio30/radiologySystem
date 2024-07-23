<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellido', 'id_paciente', 'fecha_nacimiento'
    ];

    // Encrypt data when setting
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = Crypt::encryptString($value);
    }

    public function setApellidoAttribute($value)
    {
        $this->attributes['apellido'] = Crypt::encryptString($value);
    }

    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = Crypt::encryptString($value);
    }

    // Decrypt data when getting
    public function getNombreAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getApellidoAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getFechaNacimientoAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
