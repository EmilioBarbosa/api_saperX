<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    /**
     * Função para buscar todos os contatos
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Função para salvar um contato
     * recebe como paramêtro um inteiro e um número que é opcional
     * caso receba um número armazena o número
     */
    public function store(Request $request)
    {
        $user = User::create(['name'=>$request->name]);
        if ($request->number){
            $user->phones()->create(['number'=>$request->number]);
        }
       return response()->json($user, 201);
    }
    /**
     * Função para buscar um os contato e seus telefones
     * recebe como paramêtro um inteiro
     */
    public function show(int $user)
    {
        $user = User::with('phones')->find($user);
        if ($user === null){
            return response()->json(['message'=> 'usuário não encontrado'], 404);
        }
        return $user;
    }
    /**
     * Função para editar o nome de um contato
     * recebe como paramêtro um objeto User e o nome do contato
     */
    public function update(User $user, Request $request)
    {
        $user->fill($request->all());
        $user->save();

        return $user;
    }
    /**
     * Função para deletar um contato, e com isso já deleta todos os números dele
     * recebe como paramêtro um inteiro
     */
    public function destroy(int $user)
    {
        User::destroy($user);
        return response()->noContent();
    }


}
