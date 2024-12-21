<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersChat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rfcsupplier()
    {
        return $this->belongsTo(RfcSupplier::class, 'rfc_suppliers_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_admin_id', 'id');
    }
}
