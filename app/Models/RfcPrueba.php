<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfcPrueba extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rfc_pruebas', 'rfc_prueba_id', 'user_id')
        ->withPivot('status', 'principal', 'observation');
    }
}
