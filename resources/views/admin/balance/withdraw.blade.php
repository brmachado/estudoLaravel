@extends('adminlte::page')

@section('title', 'Novo Saque')

@section('content_header')
    <h1>Novo Saque</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Saque</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Saque</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <form class="form" action="{{route('withdraw.store')}}" method="post">
                {!! csrf_field() !!}
                <div class="input-group input-group-sm col-xs-5">
                    <input type="text" name="value" placeholder="Valor do Saque" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Sacar</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
@stop