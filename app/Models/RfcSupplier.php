<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfcSupplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rfc_suppliers', 'rfc_suppliers_id', 'user_id')
        ->withPivot( 'principal');
    }

    public function chats()
    {
        return $this->hasMany(SuppliersChat::class, 'rfc_suppliers_id', 'id');
    }
}
