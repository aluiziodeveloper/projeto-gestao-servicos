<?php

namespace GestaoServicos\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mnabialek\LaravelEloquentFilter\Traits\Filterable;

class Atividade extends Model
{
    use Filterable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ordem',
        'nota',
        'estacao',
        'equipamento',
        'tipo',
        'titulo',
        'data_inicio',
        'data_fim',
        'si',
        'apr',
        'equipe',
        'relatorio',
        'encerrado',
        'created_at'
    ];

    public function photos()
    {
        return $this->hasMany(AtividadeFoto::class);
    }
}
