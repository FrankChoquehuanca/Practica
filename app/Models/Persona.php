<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = ['nombres','apellidos','direccion','celular','dni','gmail','estado_civil','genero',];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function asignacion()
    {
        return $this->hasOne(Asignacion::class);
    }
}
