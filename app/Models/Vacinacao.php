<?php

namespace App\Models;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacinacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vacinacoes';

    protected $fillable = [
        'vacina_id',
        'data_vacinacao',
        'dose',
        'reforco',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_vacinacao',
    ];

    protected $casts = [
        'reforco' => 'boolean',
    ];


    /**
     * Relations
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function vacina()
    {
        return $this->belongsTo(Vacina::class);
    }
}
