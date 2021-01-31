@extends('templates.master')



@section('conteudo-view')

{!! Form::model($voo, ['route' => ['voo.update', $voo->id ],'method' => 'put', 'class' => 'form-padrao', 'enctype' => 'multipart/form-data']) !!}

@include('templates.formulario.input', ['input' => 'classe_voo', 'attributes' => ['placeholder' => 'Classe']])

@include('templates.formulario.input', ['input' => 'cidade_destino', 'attributes' => ['placeholder' => 'Cidade destino']])

@include('templates.formulario.input', ['input' => 'hora_partida', 'attributes' => ['placeholder' => 'Hora Partida']])

@include('templates.formulario.input', ['input' => 'hora_chegada', 'attributes' => ['placeholder' => 'Hora Chegada']])

@include('templates.formulario.input', ['input' => 'local_partida', 'attributes' => ['placeholder' => 'Local Partida']])

@include('templates.formulario.input', ['input' => 'local_desembarque', 'attributes' => ['placeholder' => 'Local Desembarque']])

@include('templates.formulario.select', ['select' => 'id_piloto', 'label' => 'Piloto','data' => $pilotos_list ,'attributes' => ['placeholder' => 'Piloto do Voo']])

@include('templates.formulario.input', ['input' => 'valor', 'attributes' => ['placeholder' => 'Valor Voo']])


@include('templates.formulario.upload')

@include('templates.formulario.submit', ['input' => 'atualizar'])

{!! Form::close() !!}





@endsection