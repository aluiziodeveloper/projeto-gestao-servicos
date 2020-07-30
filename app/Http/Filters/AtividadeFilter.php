<?php

namespace GestaoServicos\Http\Filters;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;

class AtividadeFilter extends SimpleQueryFilter
{
    protected $simpleFilters = [
        'search'
    ];

    protected $simpleSorts = [
        'id',
        'ordem',
        'nota',
        'estacao',
        'equipamento',
        'titulo',
        'si',
        'equipe',
        'created_at'
    ];

    protected function applySearch($value)
    {
        $this->query->where('ordem', 'LIKE', "%$value%")
            ->orWhere('nota', 'LIKE', "%$value%")
            ->orWhere('titulo', 'LIKE', "%$value%")
            ->orWhere('si', 'LIKE', "%$value%")
            ->orWhere('estacao', 'LIKE', "%$value%")
            ->orWhere('equipe', 'LIKE', "%$value%")
            ->orWhere('equipamento', 'LIKE', "%$value%");
    }
}
