<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function professionals()
    {
        return $this->hasMany(Professional::class, 'occupation_id', 'id');
    }
}
