<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(RfcSupplier::class, 'rfc_suppliers_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bussines()
    {
        return $this->belongsTo(RfcBussines::class, 'rfc_bussines_id', 'id');
    }

    public function chats()
    {
        return $this->hasMany(SupplierRequestChat::class, 'supplier_request_id', 'id');
    }
}

