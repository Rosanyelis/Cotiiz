<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRfcSupplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rfcsupplier()
    {
        return $this->belongsTo(RfcSupplier::class, 'rfc_supplier_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
