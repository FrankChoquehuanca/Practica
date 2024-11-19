<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    use HasFactory;
    protected $fillable=['nombre','relacion_id','cargoadicional_id'];
    public function relacion()
    {
        return $this->belongsTo(Relacion::class);
    }

    public function cargoadicional()
    {
        return $this->belongsTo(Cargoadicional::class);
    }
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
