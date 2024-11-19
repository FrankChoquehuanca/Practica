<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $fillable=['observaciones','estado','fechainicio','fechafinal','persona_id','user_id','directorio_id'];
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function directorio()
    {
        return $this->belongsTo(Directorio::class);
    }
    public function monitoreos()
    {
        return $this->hasMany(Monitoreo::class);
    }
}
