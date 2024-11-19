<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion extends Model
{
    use HasFactory;
    protected $fillable=['gerencia_id','subgerencia_id','departamento_id','unidad_id','area_id'];
    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class);
    }
    public function subgerencia()
    {
        return $this->belongsTo(Subgerencia::class);
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
