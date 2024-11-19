<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $fillable=['nombre','horainicio','horafinal'];
    public function monitoreoturnos()
    {
        return $this->hasMany(Monitoreoturno::class);
    }
    public function monitoreos()
    {
        return $this->hasMany(Monitoreo::class);
    }
}
