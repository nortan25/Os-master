<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Certifique-se de ter o modelo Cliente
use App\Models\Ordem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TCPDF;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Redirect;
use App\Models\Funcionario;


class OrdensController extends Controller
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


    public function index()
    {
        // Recupere todas as ordens
        $ordens = Ordem::all();

        // Retorne a view com as ordens
        return view('ordens_servico', compact('ordens'));
    }

    /**
     * Exibe o formulário para criar uma nova ordem de serviço.
     */
    public function create()
    {
        return view('add_ordem');
    }

    public function store(Request $request)
{
    // Criar uma nova ordem
    $ordem = new Ordem();
    
    // Preencher os campos com os dados do request
    $ordem->cliente = $request->cliente;
    $ordem->cidade = $request->cidade;
    $ordem->cep = $request->cep;
    $ordem->rua = $request->rua;
    $ordem->bairro = $request->bairro;
    $ordem->modelo = $request->modelo;
    $ordem->problema = $request->problema;
    $ordem->phone_number = $request->phone_number;
    
    // Aqui, você pode obter os nomes do técnico e do atendente a partir dos seus IDs
    $tecnico = Funcionario::find($request->tecnico);
    $atendente = Funcionario::find($request->atendente);
    
    // Verifique se os técnicos e atendentes foram encontrados
    if ($tecnico && $atendente) {
        // Preencha os nomes do técnico e do atendente na ordem
        $ordem->tecnico = $tecnico->tecnico;
        $ordem->atendente = $atendente->atendente;
        
        // Preencha os demais campos
        $ordem->numero = $request->numero;

        // Salvar a ordem de serviço
        $ordem->save();

        // Redirecionar de volta à página de listagem de ordens de serviço com uma mensagem de sucesso
        return redirect()->route('pdf');
    } else {
        // Se um técnico ou atendente não foi encontrado, retorne um erro
        return redirect()->back()->with('error', 'Técnico ou atendente não encontrado.');
    }
}






    public function buscarCliente(Request $request)
{
    $query = $request->input('query', '');
    $clients = Cliente::where('name', 'like', '%' . $query . '%')
        ->orWhere('email', 'like', '%' . $query . '%')
        ->orWhere('phone_number', 'like', '%' . $query . '%')
        ->get();

    return response()->json($clients);
}

public function show($id)
    {
        $client = Cliente::find($id);

        if (!$client) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }

        return response()->json($client);
    }

}