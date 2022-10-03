<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liquidacion extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'liquidacion_detalles_id',
        'lote',
        'cot_ag',
        'cot_pb',
        'smc_ag',
        'smc_pb',
        'tmh',
        'humedad',
        'glosario',
        'valoradicional'
    ];
    public function LeyesDetalle(){
        return $this->hasMany(leyes::class);
    }
    public function liquidacionDetalle(){
        return $this->belongsTo(liquidacionDetalles::class);
    }
    public function elemento(){
        return $this->hasMany(elementos::class);
    }


}
