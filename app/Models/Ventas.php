<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    public function cliente(){
        return $this->belongsTo(Clientes::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comprobante(){
        return $this->belongsTo(Comprobantes::class);
    }

    public function productos(){
        return $this->belongsToMany(productos::class)->withTimestamps()->withPivot('cantidad','precio_venta','descuento');
    }
    //
}
