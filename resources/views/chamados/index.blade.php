@extends('layout')

@section('cabecalho')
    Chamados
@endsection

@section('conteudo')

    <ul class="list-group">

    @can('create', App\Http\Models\Chamado::class)
        <a href="/chamado/novo" class="btn btn-dark mb-2">Abrir Chamado</a>
    @endcan



    @forelse ($chamados as $chamado)

    @can('view', $chamado)
        <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="tituloChamado-{{ $chamado->id }}">{{ $chamado->titulo }}</span>

        @can('update', $chamado)
            <a href="/chamado/mostrar/{{$chamado->id}}" class="btn btn-dark mb-2">Editar</a>
        @endcan


        {{-- @can('delete', $chamado) --}}
        @can('delete', $chamado)
            <a href="/chamado/mostrar/{{$chamado->id}}" class="btn btn-danger mb-2">Deletar</a>
        @endcan

    @endcan

    @empty
        <h2>Nenhum Chamado.</h2>
    @endforelse
    </ul>
@endsection
