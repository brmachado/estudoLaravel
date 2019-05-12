@extends('adminlte::page')

@section('title', 'Novo Depósito')

@section('content_header')
    <h1>Novo Depósito</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depósito</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Depósito</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <form class="form" action="{{route('deposit.store')}}" method="post">
                {!! csrf_field() !!}
                <div class="input-group input-group-sm col-xs-5">
                    <input type="text" name="value" placeholder="Valor do Depósito" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Depositar</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
@stop