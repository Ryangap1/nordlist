<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    public function compras(){
        return $this->belongsToMany(Compras::class)->withTimestamps()->withPivot('cantidad','precio_compra','precio_venta');
    }

    public function ventas(){
        return $this->belongsToMany(Ventas::class)->withTimestamps()->withPivot('cantidad','precio_venta','descuento');
    }

    public function categoria(){
        return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function marca(){
        return $this->belongsTo(Marcas::class);
    }

    public function presentacion(){
        return $this->belongsTo(Presentaciones::class);
    }
    //
}
