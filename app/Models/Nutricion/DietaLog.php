<?php

namespace App\Models\Nutricion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietaLog extends Model
{
    use HasFactory;
    protected $table = "dietas_monitor_logs";
    protected $guarded = ['id'];
}
