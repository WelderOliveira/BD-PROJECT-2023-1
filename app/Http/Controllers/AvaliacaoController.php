<?php

namespace App\Http\Controllers;

use App\Models\AvaliacoesModel;
use App\Models\DenunciasModel;
use App\Models\TurmasModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AvaliacaoController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $responses = AvaliacoesModel::getAvaliacoes();
        return view('avaliacao.index')->with('responses', $responses);
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create($id)
    {
        $response = TurmasModel::getTurmaById($id)[0];
        return view('avaliacao.create')->with('response', $response);
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function store(Request $request): string
    {
        $filter = [
            'usuario' => Session::get('id'),
            'turma' => $request->input('turma') ?? null,
            'nota' => $request->input('nota'),
            'descricao' => $request->input('descricao'),
            'professor' => $request->input('professor') ?? null,
        ];

        $values = array_values($filter); // Padronizando Colunas para inserção SQL

        try {
            AvaliacoesModel::createAvaliacao($values);
            $request->session()->flash('mensagem', 'Avaliação registrada com Sucesso');
            return to_route('index.turmas');

        } catch (\Exception $exception) {

            $request->session()->flash('error', $exception->getMessage());
            return to_route('index.turmas');
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return string
     * @throws \Throwable
     */
    public function denuncia(Request $request, int $id): string
    {
        $filter = [
            'descricao' => 'Favor analisar esse comentário',
            'avaliacao' => $id,
        ];

        $values = array_values($filter); // Padronizando Colunas para inserção SQL

        try {
            DenunciasModel::createDenuncia($values);
            $request->session()->flash('mensagem', 'Denuncia registrada com Sucesso');
            return to_route('index.turmas');

        } catch (\Exception $exception) {

            $request->session()->flash('error', $exception->getMessage());
            return to_route('index.turmas');
        }
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
     * @param Request $request
     * @param int $id
     * @return string
     * @throws \Throwable
     */
    public function destroy(Request $request, int $id): string
    {
        try {
            AvaliacoesModel::deleteAvaliacao($id);
            $request->session()->flash('mensagem', 'Comentário removido com Sucesso');
            return to_route('index.turmas');

        } catch (\Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            return to_route('index.turmas');
        }
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function indexDenuncia(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $responses = DenunciasModel::getAllDenuncia();
        return view('avaliacao.denuncia')->with('responses', $responses);
    }
}
