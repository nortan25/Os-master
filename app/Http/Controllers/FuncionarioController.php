<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{


/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }





    // Método para armazenar um novo técnico no banco de dados
    public function store(Request $request)
    {
        // Recupera o nome do técnico do formulário
        $nomeTecnico = $request->input('nomeTecnico');

        // Verifica se o nome não está vazio
        if (empty($nomeTecnico)) {
            return redirect()->route('clientes.create')->with('error', 'O nome do técnico não pode estar vazio.');
        }

        // Cria o técnico com base nos dados recebidos
        Funcionario::create([
            'tecnico' => $nomeTecnico,
        ]);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Técnico adicionado com sucesso.');
    }

    public function create(Request $request)
    {
        // Recupera o nome do técnico do formulário
        $nomeAtendente = $request->input('nomeAtendente');

        // Verifica se o nome não está vazio
        if (empty($nomeAtendente)) {
            return redirect()->route('clientes.create')->with('error', 'O nome do técnico não pode estar vazio.');
        }

        // Cria o técnico com base nos dados recebidos
        Funcionario::create([
            'atendente' => $nomeAtendente,
        ]);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Técnico adicionado com sucesso.');
    }


   


    public function getAtendentes()
{
    $atendentes = Funcionario::pluck('atendente', 'id')->toArray();
    return response()->json($atendentes);
}

/**
 * Remove o atendente especificado do banco de dados.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    try {
        // Encontrar o atendente pelo ID e excluí-lo
        Funcionario::destroy($id);

        // Retorna uma resposta de sucesso vazia
        return response()->noContent();
    } catch (\Exception $e) {
        // Retorna uma resposta JSON de erro em caso de falha
        return response()->json(['error' => 'Erro ao remover o atendente'], 500);
    }
}


/**
     * Remove o técnico especificado do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTecnico($id)
    {
        try {
            // Encontrar o técnico pelo ID e excluí-lo
            $tecnico = Funcionario::findOrFail($id);
            $tecnico->delete();

            // Retorna uma resposta JSON de sucesso
            return response()->json(['message' => 'Técnico removido com sucesso']);
        } catch (\Exception $e) {
            // Retorna uma resposta JSON de erro em caso de falha
            return response()->json(['error' => 'Erro ao remover o técnico'], 500);
        }
    }

    /**
     * Retorna os técnicos do banco de dados.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTecnicos()
{
    $tecnicos = Funcionario::whereNotNull('tecnico')->pluck('tecnico', 'id')->toArray();
    return response()->json($tecnicos);
}
}




