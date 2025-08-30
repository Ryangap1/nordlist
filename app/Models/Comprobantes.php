<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobantes extends Model
{
    use HasFactory;

    public function compras(){
        return $this->hasMany(Compras::class);
    }

    public function ventas(){
        return $this->hasMany(Ventas::class);
    }
    //
}
