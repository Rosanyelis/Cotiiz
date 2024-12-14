<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinesChat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bussines()
    {
        return $this->belongsTo(Bussines::class, 'bussines_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_bussines_id', 'id');
    }
}
