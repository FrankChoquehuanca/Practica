<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoreoturno extends Model
{
    use HasFactory;
    public function monitoreo()
    {
        return $this->belongsTo(Monitoreo::class);
    }
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
