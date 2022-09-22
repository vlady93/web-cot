<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidacionDetalles extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'termino_id',
        'cliente_id',
    ];
    public function penalidades(){
        return $this->hasMany(Penalidad::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function termino(){
        return $this->belongsTo(Termino::class);
    }
}
