<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRfcBussines extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rfcbussines()
    {
        return $this->belongsToMany(RfcBussines::class, 'user_rfc_bussines', 'user_id', 'rfc_bussines_id')
                    ->withPivot('principal', 'status', 'observation');
    }


}
