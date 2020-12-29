@extends('layout')

@section('cabecalho')
    {{$chamado->titulo}}
@endsection

@section('conteudo')
    {{$chamado->descricao}}
@endsection