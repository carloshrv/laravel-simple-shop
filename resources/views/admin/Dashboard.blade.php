@extends('templates.master')



@section('conteudo-view')
<a id='logout' href="{{route('admin.logout')}}">Logout</a>

{!! Form::open(['route' => 'voo.store' ,'method' => 'post', 'class' => 'form-padrao', 'enctype' => 'multipart/form-data']) !!}

@include('templates.formulario.input', ['input' => 'classe_voo', 'attributes' => ['placeholder' => 'Class'], 'label' => 'Class'])

@include('templates.formulario.input', ['input' => 'estado_destino', 'attributes' => ['placeholder' => 'Destination State'], 'label' => 'State'])

@include('templates.formulario.input', ['input' => 'hora_partida', 'attributes' => ['placeholder' => 'Check-in time'], 'label' => 'Check-in time'])

@include('templates.formulario.input', ['input' => 'hora_chegada', 'attributes' => ['placeholder' => 'Check-out time'], 'label' => 'Check-out time'])

@include('templates.formulario.input', ['input' => 'data_volta', 'attributes' => ['placeholder' => 'Check-out day'], 'label' => 'Return day'])

@include('templates.formulario.input', ['input' => 'data_partida', 'attributes' => ['placeholder' => 'Check-in day'], 'label' => 'Check-in day'])

@include('templates.formulario.input', ['input' => 'local_partida', 'attributes' => ['placeholder' => 'Check-in city'], 'label' => 'Check-in city'])

@include('templates.formulario.input', ['input' => 'local_desembarque', 'attributes' => ['placeholder' => 'Check-out city'], 'label' => 'Check-out city'])

@include('templates.formulario.select', ['select' => 'id_piloto', 'label' => 'Pilot','data' => $pilotos_list ,'attributes' => ['placeholder' => 'Pilot']])

@include('templates.formulario.input', ['input' => 'valor', 'attributes' => ['placeholder' => 'Price'], 'label' => 'Price'])


@include('templates.formulario.upload')

@include('templates.formulario.submit', ['input' => 'submit'])

{!! Form::close() !!}


<piloto-table pilots="{{ $pilotos }}"></piloto-table>

@endsection