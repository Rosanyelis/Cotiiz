<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussineRequestProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bussinesRequest()
    {
        return $this->belongsTo(BussinesRequest::class, 'bussines_request_id', 'id');
    }
}
