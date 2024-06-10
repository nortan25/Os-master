<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Ordem;

class PdfController extends Controller
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


    public function gerarPDF()
{
    // Buscar a última ordem de serviço no banco de dados
    $ultimaOrdem = Ordem::latest()->first();

    // Verificar se a ordem foi encontrada
    if ($ultimaOrdem) {
        // Instancie o Dompdf
        $pdf = new Dompdf();

        // Carregue o HTML com os dados da ordem
        $html = '
            <html>
                <head>
                    <style>
                        /* Adicione estilos CSS aqui */
                        body {
                            font-family: Arial, sans-serif;
                        }
                        .header {
                            text-align: center;
                            margin-bottom: 20px;
                        }
                        .title {
                            font-size: 24px;
                            font-weight: bold;
                        }
                        .section {
                            margin-bottom: 20px;
                        }
                        .section-title {
                            font-size: 20px;
                            font-weight: bold;
                            margin-bottom: 10px;
                        }
                        .field {
                            margin-bottom: 10px;
                        }
                        .field label {
                            font-weight: bold;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <p class="title">ASSISTÊNCIA TÉCNICA ESPECIALIZADA</p>
                        
                    </div>
                    <div class="section">
                        <p class="section-title">DADOS DO CLIENTE</p>
                        <div class="field">
                            <label>Nome:</label>
                            <span>' . $ultimaOrdem->cliente . '</span>
                        </div>


                        <div class="field">
                            <label>Endereço:</label>
                            <span>' . $ultimaOrdem->rua . ', ' . $ultimaOrdem->bairro . ', CEP: ' . $ultimaOrdem->cep . '</span>
                        </div>
                        <div class="field">
                            <label>Cidade:</label>
                            <span>' . $ultimaOrdem->cidade . '
                        </div>
                        <div class="field">
                            <label>Telefone:</label>
                            <span>' . $ultimaOrdem->phone_number . ',</span>
                        </div>
                        
                    </div>
                    <div class="section">
                        <p class="section-title">EQUIPAMENTO</p>
                        <div class="field">
                            <label>Nome do equipamento:</label>
                            <span>' . $ultimaOrdem->modelo . '</span>
                        </div>
                        
                        <div class="field">
                            <label>Serviço a ser realizado:</label>
                            <span>' . $ultimaOrdem->problema . '</span>
                        </div>
                    </div>
                    <div class="section">
                        <p class="section-title">ORDEM DE SERVIÇO Nº [Insira o número da ordem]</p>
                        <p>DATA: ____/____/____</p>
                        <!-- Adicione o resto do conteúdo conforme necessário -->
                    </div>
                </body>
            </html>
        ';

        // Carregue o HTML no Dompdf
        $pdf->loadHtml($html);

        // Renderize o PDF
        $pdf->render();

        // Envie o PDF gerado para o navegador
        return $pdf->stream('ordem_de_servico.pdf');
    } else {
        // Se nenhuma ordem foi encontrada, retorne uma mensagem de erro
        return response()->json(['error' => 'Nenhuma ordem de serviço encontrada.']);
    }
}
}
