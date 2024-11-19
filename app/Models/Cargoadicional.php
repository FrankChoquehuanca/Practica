<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargoadicional extends Model
{
    use HasFactory;
    protected $fillable=['nombre','descripcion'];
    public function directorios()
    {
        return $this->hasMany(Directorio::class);
    }
}
