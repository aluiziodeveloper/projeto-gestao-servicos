<?php

namespace GestaoServicos\Http\Resources;

use GestaoServicos\Models\Atividade;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AtividadeFotoCollection extends ResourceCollection
{
    /**
     * @var Atividade
     */
    private $atividade;

    /**
     * AtividadeFotoCollection constructor.
     */
    public function __construct($resource, Atividade $atividade)
    {
        $this->atividade = $atividade;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'atividade' => new AtividadeResource($this->atividade),
            'photos' => $this->collection->map(function ($photo) {
                return new AtividadeFotoResource($photo, true);
            })
        ];
    }
}
