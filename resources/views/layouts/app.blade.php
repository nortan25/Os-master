<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Master Os
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Adicione aqui os botões da barra esquerda, se necessário -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                           

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                            </li>

                            <!-- Novo botão "Funcionários" com o dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownFuncionarios" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Funcionários') }}
                                </a>

                                <!-- Dropdown interno para Funcionários -->
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownFuncionarios">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalRegistrarAtendente">{{ __('Adicionar Atendente') }}</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalRegistrarTecnico">{{ __('Adicionar Técnico') }}</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalRemoverAtendente">{{ __('Remover Atendente') }}</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalRemoverTecnico">{{ __('Remover Técnico') }}</a>
                                </div>
                            </li
                            
                            ><li class="nav-item">
                             <a class="nav-link" href="#" data-toggle="modal" data-target="#registerClientModal">Registrar cliente</a>
                            </li>


                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ordens.index') }}">Ordens de Serviço</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('adicionar_ordem') }}">Adicionar ordem</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <!-- Botão "Ajustes" que inicia uma rota de ajustes -->
                                    <a class="dropdown-item" href="{{ route('ajustes') }}">
                                        {{ __('Ajustes') }}
                                    </a>
                                    <!-- Botão "Logout" existente -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li> 
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    




<div class="modal fade" id="modalRegistrarTecnico" tabindex="-1" aria-labelledby="modalRegistrarTecnicoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Conteúdo do modal para registrar técnico -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarTecnicoLabel">Registrar Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para adicionar técnico -->
                <form id="formRegistrarTecnico" action="{{ route('adicionar_tecnico') }}" method="post">
                    @csrf <!-- Adiciona o token CSRF para proteção contra CSRF -->
                    <div class="form-group">
                        <label for="nomeTecnico">Nome:</label>
                        <input type="text" class="form-control" id="nomeTecnico" name="nomeTecnico" placeholder="Digite o nome do técnico" required>
                    </div>
                    <!-- Outros campos do formulário podem ser adicionados conforme necessário -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <!-- Botão de enviar formulário para registrar técnico -->
                <button type="submit" class="btn btn-primary" form="formRegistrarTecnico">Salvar</button>
            </div>
        </div>
    </div>
</div>







<!-- Modal "Registrar Atendente" -->
<!-- Modal "Registrar Atendente" -->
<div class="modal fade" id="modalRegistrarAtendente" tabindex="-1" aria-labelledby="modalRegistrarAtendenteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Conteúdo do modal para registrar atendente -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarAtendenteLabel">Registrar Atendente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para registrar atendente -->
                <form id="formRegistrarAtendente" action="{{ route('registrar-atendente') }}" method="post">
                    @csrf <!-- Adiciona o token CSRF para proteção contra CSRF -->
                    <!-- Campo do formulário para o nome do atendente -->
                    <div class="form-group">
                        <label for="nomeAtendente">Nome do Atendente:</label>
                        <input type="text" class="form-control" id="nomeAtendente" name="nomeAtendente" placeholder="Digite o nome do atendente" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <!-- Botão de enviar formulário para registrar atendente -->
                <button type="submit" form="formRegistrarAtendente" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal "Remover Atendente" -->
<div class="modal fade" id="modalRemoverAtendente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover Atendente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para remover atendente -->
                <form id="formRemoverAtendente" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Dropdown para selecionar o atendente -->
                    <div class="form-group">
                        <label for="atendenteDropdown">Selecione o Atendente:</label>
                        <select class="form-control" id="atendenteDropdown">
                            <!-- Opções serão adicionadas dinamicamente via AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <!-- Botão de remover atendente -->
                <button type="button" class="btn btn-danger" id="btnRemoverAtendente">Remover</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal "Remover Técnico" -->
<div class="modal fade" id="modalRemoverTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para remover técnico -->
                <form id="formRemoverTecnico" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Dropdown para selecionar o técnico -->
                    <div class="form-group">
                        <label for="tecnicoDropdown">Selecione o Técnico:</label>
                        <select class="form-control" id="tecnicoDropdown">
                            <!-- Opções serão adicionadas dinamicamente via AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <!-- Botão de remover técnico -->
                <button type="button" class="btn btn-danger" id="btnRemoverTecnico">Remover</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal HTML -->
<div class="modal fade" id="registerClientModal" tabindex="-1" role="dialog" aria-labelledby="registerClientModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerClientModalLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="registerClientForm" method="POST" action="{{ route('clientes.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone_number">Telefone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
          </div>
          <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="city">Cidade</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group col-md-6">
              <label for="neighborhood">Bairro</label>
              <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="street">Rua</label>
              <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="form-group col-md-4">
              <label for="house_number">Número</label>
              <input type="text" class="form-control" id="house_number" name="house_number" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Registrar Cliente</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cep').on('input', function () {
            var cep = $(this).val().replace(/\D/g, '');

            if (cep.length != 8) {
                return;
            }

            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function (data) {
                if (!("erro" in data)) {
                    $('#city').val(data.localidade);
                    $('#neighborhood').val(data.bairro);
                    $('#street').val(data.logradouro);
                }
            });
        });
    });
</script>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        $('#registerClientForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Verifica se a resposta contém a propriedade 'message'
                    if (response.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: response.message,
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // Se não houver 'message', exibe uma mensagem de erro genérica
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Não foi possível processar sua solicitação.',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Exibe uma mensagem de erro com o status da resposta
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Ocorreu um erro: ' + xhr.status + ' ' + error,
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });
    });


   
</script>


<!-- Coloque isso no final do seu arquivo HTML ou em um arquivo JavaScript separado -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Carregar os nomes dos atendentes no dropdown
        $.get('/atendentes', function(data) {
            $.each(data, function(key, value) {
                $('#atendenteDropdown').append($('<option>', {
                    value: key,
                    text: value
                }));
            });
        });

        // Evento de clique no botão "Remover"
        $('#btnRemoverAtendente').click(function() {
            // Obter o ID do atendente selecionado no dropdown
            var atendenteId = $('#atendenteDropdown').val();

            // Atualizar o action do formulário com o ID selecionado
            $('#formRemoverAtendente').attr('action', '/remover-atendente/' + atendenteId);

            // Submeter o formulário para remover o atendente
            $('#formRemoverAtendente').submit();
        });

        // Manipular a submissão do formulário de remoção de atendente
        $('#formRemoverAtendente').on('submit', function(e) {
            e.preventDefault();

            var actionUrl = $(this).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Atendente removido com sucesso.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Houve um problema ao remover o atendente.',
                    });
                }
            });
        });
    });
</script>


<!-- Inclua a biblioteca SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script para carregar e remover técnicos -->
<script>
    $(document).ready(function() {
        // Carregar os nomes dos técnicos no dropdown
        $.get('/tecnicos', function(data) {
            $.each(data, function(key, value) {
                $('#tecnicoDropdown').append($('<option>', {
                    value: key,
                    text: value
                }));
            });
        });

        // Evento de clique no botão "Remover" dentro do modal
        $('#modalRemoverTecnico').on('click', '#btnRemoverTecnico', function() {
            // Obter o ID do técnico selecionado no dropdown
            var tecnicoId = $('#tecnicoDropdown').val();

            // Atualizar o action do formulário com o ID selecionado
            $('#formRemoverTecnico').attr('action', '/remover-tecnico/' + tecnicoId);

            // Submeter o formulário para remover o técnico
            $('#formRemoverTecnico').submit();
        });

        // Manipular a submissão do formulário de remoção de técnico
        $('#formRemoverTecnico').on('submit', function(e) {
            e.preventDefault();

            var actionUrl = $(this).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Técnico removido com sucesso.',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Opcional: remover o técnico do dropdown após a remoção
                    $('#tecnicoDropdown option[value="' + tecnicoId + '"]').remove();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Houve um problema ao remover o técnico.',
                    });
                }
            });
        });
    });
</script>






<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    // Adiciona um evento de clique para cada item do dropdown
    $('.dropdown-item').on('click', function(event) {
        // Impede o comportamento padrão do link
        event.preventDefault();

        // Obtém o valor do atributo data-target para identificar o modal a ser exibido
        var targetModal = $(this).data('target');

        // Abre o modal correspondente
        $(targetModal).modal('show');
    });

    // Adiciona um evento de clique ao botão "Registrar Funcionários"
    $('#dropdownFuncionarios').on('click', function(event) {
        // Impede o comportamento padrão do link
        event.preventDefault();

        // Seleciona o dropdown interno para Funcionários
        var dropdownMenu = $(this).next('.dropdown-menu');

        // Exibe ou oculta suavemente o dropdown interno
        dropdownMenu.slideToggle('fast');
    });

    // Impede que o dropdown interno seja fechado quando clicamos dentro dele
    $('.dropdown-menu').on('click', function(event) {
        event.stopPropagation();
    });

    // Fecha o dropdown interno quando clicamos fora dele
    $(document).on('click', function(event) {
        $('.dropdown-menu').slideUp('fast');
    });
</script>