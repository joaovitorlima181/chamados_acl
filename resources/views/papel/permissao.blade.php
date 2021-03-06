@extends('layout')

@section('cabecalho')
    Papéis
@endsection
@section('conteudo')
<div class="container">
    <h2 class="center">Lista de Permissões para {{$papel->nome}}</h2>

    <div class="row">
        <form action="{{route('papeis.permissao.store',$papel->id)}}" method="post">
        {{ csrf_field() }}
        <div class="input-field">
            <select name="permissao_id">
                @foreach($permissoes as $permissao)
                <option value="{{$permissao->id}}">{{$permissao->nome}}</option>
                @endforeach
            </select>
        </div>
            <button class="btn blue">Adicionar</button>
        </form>


    </div>

    <div class="row">
        <table>
            <thead>
                <tr>

                    <th>Permissão</th>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            @foreach($papel->permissoes as $permissao)
                <tr>
                    <td>{{ $permissao->nome }}</td>
                    <td>{{ $permissao->descricao }}</td>

                    <td>

                        <form action="{{route('papeis.permissao.destroy',[$papel->id,$permissao->id])}}" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button title="Deletar" class="btn red"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection