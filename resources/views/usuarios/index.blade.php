@extends('layout')

@section('cabecalho')
    Usuários
@endsection
@section('conteudo')
    <ul>
        @forelse ($users as $user)
            <li>{{ $user->name }} <a href={{route('users.papel', $user->id)}}>Editar</a></li>
            
        @empty
            Nenhum usuário
        @endforelse
    </ul>
@endsection