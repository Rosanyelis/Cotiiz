<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rfcsupplier()
    {
        return $this->belongsTo(RfcSupplier::class, 'rfc_suppliers_id', 'id');
    }
}
