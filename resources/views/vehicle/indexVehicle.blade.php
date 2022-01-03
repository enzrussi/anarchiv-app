@extends('base')
@section('content')
    @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<div class="row w-100 mt-5">
    <div class="col-10  bg-primary text-white align-middle pt-2">
        Esito Ricerca Veicolo
    </div>
    <div class="col-2 text-right">
        <a href="{{route('vehicle.create')}}" class="btn btn-primary btn-sm"> Inserisci Nuovo</a>
    </div>
</div>

@foreach ($vehicles as $v)
<div class="row shadow p-3 mt-2 bg-white">
    <div class="col-8">
        <div class="row w-100">
            <div class="col-4">Targa: {{$v->plate}}</div>
            <div class="col-4">Modello: {{$v->model}}</div>
            <div class="col-4">Colore: {{$v->color}}</div>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-4">Soggetti Collegati:</div>
            <div class="col-8">
                @foreach ($v->subjects as $s )
                    <div class="chip chip-lg">
                        <div class="avatar size-xs"><img src="{{asset('photo')}}/{{$s->photo}}"></div>
                        <span class="chip-label">
                            <a href="{{route('subject.show',['id'=>$s->id,'tab'=>3])}}" data-toggle="tooltip" title="{{$s->pivot->relationship}}">
                                <span class="text-uppercase">{{$s->surname}}</span>
                                <span class="text-capitalize"> {{$s->name}}</span>
                                <span> {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                            </a>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-4 text-right">
        <a href="{{route('vehicle.show',$v->id)}}" class="btn"><svg class="icon">
            <use xlink:href="{{asset('svg/sprite.svg')}}#it-more-actions"></use></svg>
        </a>
    </div>
</div>
@endforeach

@endsection
