<?php

namespace App\Models\Guardia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDieta extends Model
{
    use HasFactory;
    protected $table = "dietas_monitor";
    protected $guarded = ['id'];


}
