@extends('layout')

@section('cabecalho')
    Lista de Papeis para {{$user->name}}
@endsection
@section('conteudo')

<div class="row">
    <form action="{{route('users.papel.store',$user->id)}}" method="post">
        {{ csrf_field() }}
        
        <div class="input-field">
            <select name="papel_id">
                @foreach($papeis as $papel)
                <option value="{{$papel->id}}">{{$papel->nome}}</option>
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

                <th>Papel</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        @foreach($user->papeis as $papel)
            <tr>
                <td>{{ $papel->nome }}</td>
                <td>{{ $papel->descricao }}</td>

                <td>
                    <form action="{{route('users.papel.destroy',[$user->id, $papel->id])}}" method="post">
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
@endsection