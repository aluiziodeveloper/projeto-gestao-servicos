<?php

namespace GestaoServicos\Http\Filters;

use GestaoServicos\Models\User;
use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;

class UserFilter extends SimpleQueryFilter
{
    protected $simpleFilters = [
        'search',
        'role'
    ];

    protected $simpleSorts = [
        'id',
        'name',
        'email',
        'created_at'
    ];

    protected function applySearch($value)
    {
        $this->query->where('name', 'LIKE', "%$value%")
            ->orWhere('email', 'LIKE', "%$value%")
            ->orWhere('created_at', 'LIKE', "%$value%");
    }

    protected function applyRole($value)
    {
        $role = $value == 'admin' ? 1 : 2;
        $this->query->where('role', $role);
    }

    public function hasFilterParameter()
    {
        $contains = $this->parser->getFilters()->contains(function ($filter) {
            return $filter->getField() === 'search' && !empty($filter->getValue());
        });
        return $contains;
    }
}
