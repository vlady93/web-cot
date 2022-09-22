<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termino extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_id',
        'merma',
        'valorag',
        'porcentag',
        'maquila',
        'base',
        'refincaion',
        'escalador',
        'flete',
        'rollback',
        'comibol',
        'fedecomin',
        'fencomin',
        'remesa',
    ];
    public function liquidacion()
    {
        return $this->belongsTo(liquidacion::class);
    }
    public function tipo(){
        return $this->belongsTo(tipo::class);
    }
}
