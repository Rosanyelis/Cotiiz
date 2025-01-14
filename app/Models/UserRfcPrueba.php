<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRfcPrueba extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rfcPrueba()
    {
        return $this->belongsTo(RfcPrueba::class, 'rfc_prueba_id', 'id');
    }
}
