<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfcBussines extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rfc_bussines', 'rfc_bussines_id', 'user_id')
        ->withPivot('status', 'principal', 'observation');
    }
}
