@extends('adminlte::page')

@section('title', 'Histórico')

@section('content_header')
    <h1>Histórico</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Historico</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Depósito</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Usuário da Operação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historics as $historic)
                    <tr>
                        <th>{{ $historic->id }}</th>
                        <th>{{ number_format($historic->amount, '2', ',', '') }}</th>
                        <th>{{ $historic->type($historic->type) }}</th>
                        <th>{{ $historic->date }}</th>
                        <th>
                            @if($historic->user_id_transaction != null)
                            {{ $historic->userSender->name }}
                            @else
                                -
                            @endif
                        </th>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop