@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{route('balance.deposit')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Depósito</a>
            <a href="{{route('balance.withdraw')}}" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Saque</a>
            <a href="{{route('balance.transfer')}}" class="btn btn-info"><span class="glyphicon glyphicon-transfer"></span> Transferir</a>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box {{$amount >= 0? 'bg-green' : 'bg-red'}}">
                        <div class="inner">
                            <h3>R$ {{number_format($amount, 2, ',', '')}}</h3>

                            <p>Itau</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop