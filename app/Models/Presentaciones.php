<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentaciones extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(productos::class);
    }

    public function caracteristicas(){
        return $this->belongsTo(Caracteristicas::class);
    }
    //
}
