<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller



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

    
    // Método para exibir a lista de clientes com suporte a pesquisa, ordenação e paginação
    public function index(Request $request)
    {
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        // Utiliza um query builder para filtrar, ordenar e paginar os clientes
        $clients = Cliente::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone_number', 'like', '%' . $query . '%');
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(10);

        return view('clientes.index', compact('clients'));
    }

    

    public function store(Request $request)
{
    // Valida os dados recebidos
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:clientes',
        'phone_number' => 'required|string|max:20',
        'cep' => 'required|string|max:10',
        'city' => 'required|string|max:255',
        'neighborhood' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'house_number' => 'required|string|max:10',
    ], [
        'name.required' => 'O campo nome é obrigatório.',
        // Adicione mensagens personalizadas para outros campos conforme necessário
    ]);

    // Se a validação falhar, redirecione de volta com os erros
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        // Cria um novo cliente com os dados validados
        $cliente = Cliente::create($validator->validated());

        // Retorna uma resposta JSON de sucesso
        return response()->json(['message' => 'Cliente criado com sucesso!'], 200);
    } catch (\Exception $e) {
        // Trata exceções durante a criação do cliente
        return response()->json(['error' => 'Erro ao criar o cliente: ' . $e->getMessage()], 500);
    }
}


    




    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Encontra o cliente no banco de dados
        $cliente = Cliente::findOrFail($id);

        // Valida os dados recebidos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes,email,' . $cliente->id,
            'phone_number' => 'required|string|max:20',
            'cep' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
        ]);

        // Se a validação falhar, redirecione de volta com os erros
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Atualiza os dados do cliente com os novos dados
        $cliente->update($request->all());

        // Retorna uma resposta JSON de sucesso
        return response()->json(['message' => 'Cliente atualizado com sucesso!'], 200);
    }


    // Método para excluir um cliente do banco de dados
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    // Método para buscar clientes com base na query, ordenação e paginação
    public function search(Request $request)
    {
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        $clients = Cliente::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('phone_number', 'like', '%' . $query . '%')
            ->orderBy($orderBy, $orderDirection)
            ->paginate(10);

        return response()->json($clients);
    }
    
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $clientes = Cliente::where('nome', 'like', '%' . $query . '%')->get();
        return response()->json($clientes);
    }
}

