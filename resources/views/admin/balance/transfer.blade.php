@extends('adminlte::page')

@section('title', 'Nova Tranferencia')

@section('content_header')
    <h1>Nova Tranferencia</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferencia</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transferencia</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <form class="form" action="{{route('transfer.confirm')}}" method="post">
                {!! csrf_field() !!}
                <div class="input-group input-group-sm col-xs-5">
                    <input type="text" name="sender" placeholder="Email do beneficiario" class="form-control">
{{--                    <input type="text" name="value" placeholder="Valor da transferencia" class="form-control">--}}
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Próximo</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
@stop