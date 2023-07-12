<?php

namespace App\Http\Controllers;

use App\Models\UsuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsuariosController extends Controller
{
    /**
     * @param Request $request
     * @return bool
     */
    public function verifyUser(Request $request): bool
    {
        $validated = $request->validate([
            'email' => 'bail|email',
            'senha' => 'bail|string'
        ]);

        $searchUser = UsuariosModel::getUsuario($validated['email'], $validated['senha']);

        if (!empty($searchUser)) {
            Session::put('id', $searchUser[0]->id);
            Session::put('user_type', $searchUser[0]->tipo_usuario);
            return true;
        }

        return false;
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
        $validated = $request->validate([
            'nome' => 'bail|string',
            'email' => 'bail|email',
            'matricula' => 'bail|integer',
            'curso' => 'bail|string',
            'senha' => 'bail|string',
            'avatar' => 'bail|nullable',
            'tipo_usuario' => 'bail|integer'
        ]);

        $values = array_values($validated); // Padronizando Colunas para inserção SQL

        return UsuariosModel::createUser($values);
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
                'tipo_usuario' => 'bail|integer'
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
