<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgerencia extends Model
{
    use HasFactory;
    protected $fillable=['nombre','descripcion'];
    public function relacions()
    {
        return $this->hasMany(Relacion::class);
    }
}
