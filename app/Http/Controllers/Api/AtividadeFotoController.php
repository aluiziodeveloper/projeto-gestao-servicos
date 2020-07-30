<?php

namespace GestaoServicos\Http\Controllers\Api;

use GestaoServicos\Http\Controllers\Controller;
use GestaoServicos\Http\Requests\AtividadeFotoRequest;
use GestaoServicos\Http\Resources\AtividadeFotoCollection;
use GestaoServicos\Http\Resources\AtividadeFotoResource;
use GestaoServicos\Models\Atividade;
use GestaoServicos\Models\AtividadeFoto;

class AtividadeFotoController extends Controller
{
    public function index(Atividade $atividade)
    {
        return new AtividadeFotoCollection($atividade->photos, $atividade);
    }

    public function store(AtividadeFotoRequest $request, Atividade $atividade)
    {
        $photos = AtividadeFoto::createWithPhotosFiles($atividade->id, $request->photos);
        return response()->json(new AtividadeFotoCollection($photos, $atividade), 201);
    }

    public function show(Atividade $atividade, AtividadeFoto $photo)
    {
        $this->assertAtividadeFoto($atividade, $photo);
        return new AtividadeFotoResource($photo);
    }

    public function update(AtividadeFotoRequest $request, Atividade $atividade, AtividadeFoto $photo)
    {
        $this->assertAtividadeFoto($atividade, $photo);
        $photo = $photo->updateWithPhoto($request->photo);
        return new AtividadeFotoResource($photo);
    }

    public function destroy(Atividade $atividade, AtividadeFoto $photo)
    {
        $this->assertAtividadeFoto($atividade, $photo);
        $photo->deleteWithPhoto();
        return response()->json([], 204);
    }

    private function assertAtividadeFoto(Atividade $atividade, AtividadeFoto $photo)
    {
        if ($photo->atividade_id != $atividade->id) {
            abort(404);
        }
    }
}
