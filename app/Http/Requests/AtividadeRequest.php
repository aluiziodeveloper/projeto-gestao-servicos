<?php

namespace GestaoServicos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ordem' => 'max:30',
            'nota' => 'max:30',
            'estacao' => 'required|max:10',
            'equipamento' => 'required|max:100',
            'tipo' => 'required|max:20',
            'titulo' => 'required|max:255',
            'data_inicio' => 'datetime',
            'data_fim' => 'datetime',
            'si' => 'max:100',
            'apr' => 'max:100',
            'equipe' => 'required',
            'relatorio' => 'nullable',
            'encerrado' => 'boolean',
        ];
    }
}
