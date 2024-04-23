<?php

namespace App\Models\Nutricion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColacionFrecuencia extends Model
{
    use HasFactory;
    protected $table = "nut_colacion_frec";

    protected $guarded = ['id'];

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
