<?php

namespace App\Http\Controllers;

use App\Models\AvaliacoesModel;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    /**
     * @param $filter
     * @return array
     */
    public function index($filter): array
    {
        return AvaliacoesModel::getAvaliacoes($filter);
    }

    /**
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function store(Request $request): string
    {
        $validated = $request->validate([
            'fk_user' => 'bail|integer',
            'fk_turma' => 'bail|integer',
            'nota' => 'bail|integer',
            'descricao' => 'bail|string',
            'fk_professor' => 'bail|integer',
        ]);

        $values = array_values($validated); // Padronizando Colunas para inserção SQL

        return AvaliacoesModel::createAvaliacao($values);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return AvaliacoesModel::getAvaliacaoById($id)[0];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id): mixed
    {
        return AvaliacoesModel::getAvaliacaoById($id)[0];
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool|string
     * @throws \Throwable
     */
    public function update(Request $request, int $id): bool|string
    {
        try {
            $validated = $request->validate([
                'fk_user' => 'bail|integer',
                'fk_turma' => 'bail|integer',
                'nota' => 'bail|integer',
                'descricao' => 'bail|string',
                'fk_professor' => 'bail|integer',
            ]);

            AvaliacoesModel::updateAvaliacao($validated, $id);
            return json_encode(AvaliacoesModel::getAvaliacaoById($id)[0]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param int $id
     * @return string
     * @throws \Throwable
     */
    public function destroy(int $id): string
    {
        try {
            return AvaliacoesModel::deleteAvaliacao($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
