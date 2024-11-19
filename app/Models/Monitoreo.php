<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Monitoreo extends Model
{
    use HasFactory;
    protected $fillable=['horaingreso','horasalida','horacsalida','horacingreso','fecha','asignacion_id','turno_id'];
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }
    public function monitoreoturnos()
    {
        return $this->belongsToMany(Monitoreoturno::class);
    }
    public function papeletas()
    {
        return $this->hasMany(Papeleta::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function archivos(): MorphMany
    {
        return $this->morphMany(Archivo::class, 'fileable');

    }
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
