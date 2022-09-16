<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Função para buscar todos os telefones de um contato
     * recebe como paramêtro um inteiro
     */
    public function index(int $user)
    {
        $user = User::find($user);
        if (count($user->phones) > 0){
            return $user->phones;
        }
        return response()->json(['message'=> 'Nenhum telefone encontrado'],);

    }

    /**
     * Função para salvar um telefone para um usuário
     * recebe como paramêtro no request, id do contato e o numero
     */
    public function store(Request $request)
    {
        $user = User::find($request->contact);
        $user->phones()->create(['number'=>$request->number]);

        return response()->json($user, 201);
    }
    /**
     * Função para editar um telefone de um contato
     * recebe como paramêtro um inteiro e o nome
     */
    public function update(int $phone,Request $request)
    {
        $phone = Phone::find($phone);
        $phone->fill($request->all());
        $phone->save();
        return $phone;
    }
    /**
     * Função para deletar um um número de um contato
     * recebe como paramêtro um inteiro
     */
    public function destroy(int $phone)
    {
        Phone::destroy($phone);
        return response()->noContent();
    }
}
