@extends('layout')

@section('cabecalho')
    Novo Chamado
@endsection

@section('conteudo')

<form method="post">
    @csrf
    <div class="row">
        <div class="col col-7">
            <label for="nome">Título:</label>
            <input type="text" class="form-control" name="tituloChamado" id="tituloChamado" required>
        </div>

        <div class="col col-2">
            <label for="debtValue">Descrição:</label>
            <input type="textarea" class="form-control"name="descricaoChamado" id="descricaoChamado" required>
        </div>
    </div>

    <div> <button class="btn btn-primary mt-2">Adicionar</button> </div>
   
</form>
@endsection