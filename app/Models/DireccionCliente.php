<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionCliente extends Model
{
    use HasFactory;

    protected $table= 'direccion_clientes';
    protected $primaryKey = 'id';

    protected $fillable=['calle', 'num_ext', 'num_int', 'colonia', 'estado', 'pais', 'cliente_id'];
}
