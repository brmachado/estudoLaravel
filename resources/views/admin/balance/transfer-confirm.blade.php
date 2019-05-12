@extends('adminlte::page')

@section('title', 'Confirma Tranferencia')

@section('content_header')
    <h1>Confirma Tranferencia</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferencia</a></li>
        <li><a href="">Confirma Transferencia</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirma Transferencia</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')

            <p>Favorecido: <strong>{{ $sender->name }}</strong></p>

            <form class="form" action="{{ route('transfer.store') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="sender_id" value="{{ $sender->id }}">

                <div class="input-group input-group-sm col-xs-5">
                    <input type="text" name="value" placeholder="Valor da transferencia" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Transferir</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
@stop