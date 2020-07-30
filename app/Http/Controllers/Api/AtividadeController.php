<?php

namespace GestaoServicos\Http\Controllers\Api;

use GestaoServicos\Http\Controllers\Controller;
use GestaoServicos\Http\Filters\AtividadeFilter;
use GestaoServicos\Http\Requests\AtividadeRequest;
use GestaoServicos\Http\Resources\AtividadeResource;
use GestaoServicos\Models\Atividade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var AtividadeFilter $filter */
        $filter = app(AtividadeFilter::class);

        /** @var Builder $filterQuery */
        $filterQuery = Atividade::filtered($filter);

        $atividades = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(10);
        return AtividadeResource::collection($atividades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtividadeRequest $request)
    {
        $atividade = Atividade::create($request->all());
        $atividade->refresh();
        return  new AtividadeResource($atividade);
    }

    /**
     * Display the specified resource.
     *
     * @param  \GestaoServicos\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        return  new AtividadeResource($atividade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GestaoServicos\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(AtividadeRequest $request, Atividade $atividade)
    {
        $atividade->fill($request->all());
        $atividade->save();
        return  new AtividadeResource($atividade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GestaoServicos\Models\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atividade $atividade)
    {
        $atividade->delete();
        return response()->json([], 204);
    }
}
