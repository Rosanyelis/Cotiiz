<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRequestChat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplierRequest()
    {
        return $this->belongsTo(SupplierRequest::class, 'supplier_request_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }

    public function userAdmin()
    {
        return $this->belongsTo(User::class, 'user_admin_id', 'id');
    }
}
