<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    public function proveedor(){
        return $this->belongsTo(Proveedores::class);
    }

    public function comprobante(){
        return $this->belongsTo(Comprobantes::class);
    }

    public function productos(){
        return $this->belongsToMany(productos::class)->withTimestamps()->withPivot('cantidad','precio_compra','precio_venta');
    }
    //
}
