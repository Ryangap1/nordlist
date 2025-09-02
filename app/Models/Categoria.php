<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(productos::class)->withTimestamps();
    }

    public function caracteristicas(){
        return $this->belongsTo(Caracteristicas::class);
    }
    
    protected $fillable = ['caracteristica_id'];
}
