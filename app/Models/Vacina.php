<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacina extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'reference_key',
        'fabricante',
        'doses',
        'intervalo_inicial_proxima_dose',
        'intervalo_final_proxima_dose',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
