<?php

namespace App\Http\Controllers;

use App\Models\TurmasModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * @param array $filter
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(array $filter = []): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $turmas = TurmasModel::getTurmas($filter);
        return view('turma.index')->with('turmas', $turmas);
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
     * @param int $id
     * @return bool|string
     * @throws \Throwable
     */
    public function update(Request $request, int $id): bool|string
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
     * @param int $id
     * @return string
     * @throws \Throwable
     */
    public function destroy(int $id): string
    {
        try {
            return TurmasModel::deleteTurma($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
