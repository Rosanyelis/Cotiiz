<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussineRequestService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bussinesRequest()
    {
        return $this->belongsTo(BussinesRequest::class, 'bussines_request_id', 'id');
    }
}
