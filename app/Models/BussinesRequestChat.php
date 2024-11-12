<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinesRequestChat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bussinesRequest()
    {
        return $this->belongsTo(BussinesRequest::class, 'rfc_bussines_id', 'id');
    }

    public function bussines()
    {
        return $this->belongsTo(User::class, 'bussines_id', 'id');
    }

    public function userAdmin()
    {
        return $this->belongsTo(User::class, 'user_admin_id', 'id');
    }
}
