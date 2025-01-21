<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfcBussines extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'rfc_bussines';

    public function users()
    {
        return $this->belongsToMany(
            User::class,                 // Modelo relacionado
            'user_rfc_bussines',         // Nombre de la tabla pivote
            'rfc_bussines_id',           // Llave foránea del RFC
            'user_id'                    // Llave foránea del usuario
        )->withPivot('principal');       // Campos adicionales de la tabla pivote
    }

}
