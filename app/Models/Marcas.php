<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    public function productos(){
        return $this->hasMany(productos::class);
    }

    public function caracteristicas(){
        return $this->belongsTo(Caracteristicas::class);
    }
    //
}
