<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    protected $fillable = ['usuario_id', 'evento_id', 'estado'];
}
