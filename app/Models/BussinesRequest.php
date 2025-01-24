<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BussinesRequestProfessional; // Ensure this class exists in the specified namespace

class BussinesRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
        #return $this->hasMany(Rfcbussines::class, 'user_id'); // Asegúrate de usar las claves correctas
    }

    public function bussines()
    {
        return $this->belongsTo(RfcBussines::class, 'rfc_bussines_id', 'id');
    }

    public function products()
    {
        return $this->hasOne(BussineRequestProduct::class, 'bussines_request_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(BussineRequestService::class, 'bussines_request_id', 'id');
    }

    public function professionals()
    {
        return $this->hasMany(BussineRequestProfessional::class, 'bussines_request_id', 'id');
    }

    public function chats()
    {
        #return $this->hasMany(BussinesRequestChat::class, 'bussines_request_id', 'id');
        return $this->hasMany(BussinesRequestChat::class, 'bussines_request_id', 'id');
    }
}
