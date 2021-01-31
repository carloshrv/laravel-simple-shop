
@extends('templates.panel_master')

@section('panel')
    @inject('helper', App\Http\Controllers\VoosController)
    
    <ul>
        @foreach($voos as $voo)
        <li>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{asset('storage/assets/images/VooImages/')}}/{{$helper -> file_path($voo->local_desembarque)}}" alt=""/>
            <div class="card-body">
            <h5 class="card-title">{{$voo -> estado_destino}}</h5>
            <p class="card-text">Cidade Destino: {{$voo -> local_desembarque}}</p>
            <p class="card-text">Horario de Saida: {{$voo -> hora_partida}}</p>
            <p class="card-text">Chegada: {{$voo -> hora_chegada}}</p>
            <p class="card-text">Piloto: {{$voo -> piloto -> nome_piloto}}</p>
            <p class="card-text">Ida: {{$voo -> data_partida}}</p>
            <p class="card-text">Volta: {{$voo -> data_volta}}</p>
            <p class="card-text">Ativo {{$voo -> active}}</p>
            <p class="card-text">Valor: {{$voo -> valor}}</p>
            <a href="{{ route('voo.edit', $voo->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{route('voo.destroy', $voo->id)}}" class="btn btn-primary">Remove</a>
        </div>
        </li>
        @endforeach
    </ul>
@endsection


@section('conteudo-view')
@endsection
