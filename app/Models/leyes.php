<?php

namespace App\Models;

use App\Http\Controllers\LeyesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leyes extends Model
{
    use HasFactory;
    protected $fillable = [
        'liquidacion_id',
        'elemento_id',
        'valor',
    ];
    public function elemento(){
        return $this->belongsTo(elementos::class);
    }
}
