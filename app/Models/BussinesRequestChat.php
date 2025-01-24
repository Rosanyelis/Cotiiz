<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinesRequestChat extends Model
{
    use HasFactory;

    protected $table = 'bussines_request_chats';

    // Indica los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'bussines_request_id',
        'bussines_id',
        'rfc_bussines_id',
        'rfc_prueba_id',
        'user_admin_id',
        'message',
        'file',
        'name_file',
    ];

    // Relación con BussinesRequest para rfc_bussines_id
    public function bussinesRequest()
    {
        return $this->belongsTo(BussinesRequest::class, 'bussines_request_id', 'id');
    }

    // Relación con RfcBussines para EMPRESAS
    public function rfcBussines()
    {
        return $this->belongsTo(RfcBussines::class, 'rfc_bussines_id', 'id');
    }

    // Relación con RfcPrueba para EMPRESAS PRUEBA
    public function rfcPrueba()
    {
        return $this->belongsTo(RfcPrueba::class, 'rfc_prueba_id', 'id');
    }

    // Relación con Usuario
    public function bussines()
    {
        return $this->belongsTo(User::class, 'bussines_id', 'id');
    }

    // Relación con Administrador
    public function userAdmin()
    {
        return $this->belongsTo(User::class, 'user_admin_id', 'id');
    }

}
