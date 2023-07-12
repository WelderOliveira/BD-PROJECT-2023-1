<?php

namespace App\Http\Controllers;

use App\Models\UsuariosModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'bail|email',
            'senha' => 'bail|string'
        ]);

        $searchUser = UsuariosModel::getUsuario($validated['email'], $validated['senha']);

        if (!empty($searchUser)) {
            Session::put('id', $searchUser[0]->id);
            Session::put('user_type', $searchUser[0]->tipo_usuario);
            return to_route('index.turmas');
        }

        $request->session()->flash('mensagem', 'Dados incorretos.');
        return to_route('index.usuarios');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('usuario.login')->with('mensagem', $mensagem);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function register(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('usuario.register')->with('mensagem', $mensagem);
    }

    /**
     * @return void
     */
    public function create()
    {
        // Redirecionar para tela de Registro de usuário
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function store(Request $request): string
    {
        try {
            $validated = $request->validate([
                'nome' => 'bail|string',
                'email' => 'bail|email',
                'matricula' => 'bail|required|integer',
                'curso' => 'bail|string',
                'senha' => 'bail|string',
                'avatar' => 'bail|nullable',
                'tipo_usuario' => 'bail|integer'
            ]);

            $values = array_values($validated); // Padronizando Colunas para inserção SQL

            try {
                UsuariosModel::createUser($values);
                $request->session()->flash('mensagem', 'Usuário registrado com Sucesso.');
                return to_route('index.usuarios');
            } catch (\Exception $exception) {
                $request->session()->flash('mensagem', $exception);
                return to_route('register.usuario');
            }
        } catch (ValidationException|\Exception $exception) {
            $request->session()->flash('mensagem', $exception);
            return to_route('register.usuario');
        }
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function show(string $id): mixed
    {
        return UsuariosModel::getUserById($id)[0];
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function edit(string $id): mixed
    {
        return UsuariosModel::getUserById($id)[0];
    }

    /**
     * @param Request $request
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function update(Request $request, $id): string
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

            UsuariosModel::updateUser($validated, (int)$id);
            return json_encode(UsuariosModel::getUserById($id)[0]);
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
            return UsuariosModel::deleteUser($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
