@extends('base')

@section('content')

{{-- messaggio errori --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12 bg-primary text-white mt-3 p-2">
    <h6>Esito Ricerche</h6>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>Cognome</th><th>Nome</th><th>Data di Nascita</th><th>Luogo di Nascita</th><th></th>
            </tr>
        </thead>
    @foreach ($subject as $s )
        <tr>
            <td><p class="font-weight-bold text-uppercase">{{$s->surname}}</p></td>
            <td><p class="text-capitalize">{{$s->name}}</p></td>
            <td>{{date('d/m/Y',strtotime($s->birthdate))}}</td>
            <td><p class="text-capitalize">{{$s->placebirth}}</p></td>
            <td><a href="{{route('subject.show',['id'=>$s->id,'tab'=>1])}}">
                <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-external-link"></use></svg>
            </a></td>
        </tr>
    @endforeach
    </table>
</div>

@endsection

