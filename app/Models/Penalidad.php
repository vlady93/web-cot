<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalidad extends Model
{
    use HasFactory;
    protected $fillable=[
        
        'liquidacion_id',
        'elemento_id',
        'libre',
        'costo',
        'fraccion',
        'created_at'
        
    ];
    public function elemento(){
        return $this->belongsTo(elementos::class);
    }
    public $timestamps = true;
    
}
