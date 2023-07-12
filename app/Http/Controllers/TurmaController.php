<?php

namespace App\Http\Controllers;

use App\Models\TurmasModel;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * @param $filter
     * @return array
     */
    public function index($filter): array
    {
        return TurmasModel::getTurmas($filter);
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
            'turma' => 'bail|string',
            'periodo' => 'bail|string',
            'professor' => 'bail|string',
            'horario' => 'bail|string',
            'vagas_ocupadas' => 'bail|integer',
            'total_vagas' => 'bail|integer',
            'local' => 'bail|string',
            'fk_disciplina' => 'bail|string',
            'carga_horaria' => 'bail|integer',
        ]);

        $values = array_values($validated); // Padronizando Colunas para inserção SQL

        return TurmasModel::createTurma($values);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return TurmasModel::getTurmaById($id)[0];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id): mixed
    {
        return TurmasModel::getTurmaById($id)[0];
    }

    /**
     * @param Request $request
     * @param string $id
     * @return false|string
     * @throws \Throwable
     */
    public function update(Request $request, string $id): bool|string
    {
        try {
            $validated = $request->validate([
                'nome' => 'bail|string',
                'email' => 'bail|email',
                'matricula' => 'bail|integer',
                'curso' => 'bail|string',
                'senha' => 'bail|string',
                'avatar' => 'bail|nullable',
                'tipo_usuario' => 'bail|integer',
            ]);

            TurmasModel::updateTurma($validated, (int)$id);
            return json_encode(TurmasModel::getTurmaById($id)[0]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param string $id
     * @return string
     * @throws \Throwable
     */
    public function destroy(string $id): string
    {
        try {
            return TurmasModel::deleteTurma($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
