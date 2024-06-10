@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('clientes.store') }}" method="POST">
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
                    <div class="form-group col-md-2">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" required>
                        </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        
                        <div class="form-group col-md-4">
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
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

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
