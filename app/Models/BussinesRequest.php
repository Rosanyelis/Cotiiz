<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinesRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bussines()
    {
        return $this->belongsTo(RfcBussines::class, 'rfc_bussines_id', 'id');
    }

    public function chat()
    {
        return $this->hasMany(BussinesRequestChat::class, 'rfc_bussines_id', 'id');
    }
}
