<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papeleta extends Model
{
    use HasFactory;
    protected $fillable=['nombres',
    'gerencia',
    'salida' ,
    'retorno' ,
    'motivos' ,
    'lugares',
    'observaciones',
    'fecha' ,
    'jefeinmediato' ,
    'monitoreo_id' ,];
    public function monitoreo()
    {
        return $this->belongsTo(Monitoreo::class);
    }
}
