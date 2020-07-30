<?php

namespace GestaoServicos\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AtividadeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ordem' => $this->ordem,
            'nota' => $this->nota,
            'estacao' => $this->estacao,
            'equipamento' => $this->equipamento,
            'tipo' => $this->tipo,
            'titulo' => $this->titulo,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'si' => $this->si,
            'apr' => $this->apr,
            'equipe' => $this->equipe,
            'relatorio' => $this->relatorio,
            'encerrado' => (bool) $this->encerrado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
