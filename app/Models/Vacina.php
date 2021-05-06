<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fabricante',
        'total_doses',
        'intervalo_inicial_proxima_dose',
        'intervalo_final_proxima_dose',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
