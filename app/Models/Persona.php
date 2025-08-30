<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function documento(){
        return $this->belongsTo(Documento::class);
    }

    public function proveedores(){
        return $this->hasOne(Proveedores::class);
    }

    public function clientes(){
        return $this->hasOne(Clientes::class);
    }

    //
}
