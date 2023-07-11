<?php

namespace App\Http\Controllers;

use App\Models\UsuariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(Request $request)
    {
//        $image = "C:\\Users\\Will\\Pictures\\Captura de tela 2021-06-30 174209.png"; // be careful that the path is correct

//        $resp = base64_encode(file_get_contents($image));
//        dd($resp);
//        $data = fopen($image, 'rb');
//        $size = filesize($image);
//        $contents = fread($data, $size);
//        fclose($data);
//
//        $encoded = base64_encode($contents);
//
//        dd();
//        dd($request);
        $validated = $request->validate([
            'nome' => 'bail|string',
            'email' => 'bail|email',
            'matricula' => 'bail|integer',
            'curso' => 'bail|string',
            'senha' => 'bail|string',
            'avatar' => 'bail|nullable',
            'tipo_usuario' => 'bail|integer'
        ]);

        $values = array_values($validated); //Padronizando Colunas para inserção SQL

        return UsuariosModel::createUser($values);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
