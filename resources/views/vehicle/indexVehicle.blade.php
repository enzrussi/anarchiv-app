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
    <div class="col-2">
        @if($v->photovehicle == Null)
        <img src="{{asset('svg/CAR.svg')}}" style="width:150px">
        @else
        <img src="{{asset('photovehicle')}}/{{$v->photovehicle}}" style="width:150px">
        @endif
    </div>
    <div class="col-10">
        <div class="row w-100 mt-1">
            <div class="col-4">Targa: {{$v->plate}}</div>
            <div class="col-4">Modello: {{$v->model}}</div>
            <div class="col-2">Colore: {{$v->color}}</div>
            <div class="col-2 text-right">
                <a href="{{route('vehicle.show',$v->id)}}" class="btn"><svg class="icon">
                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-more-actions"></use></svg>
                </a>
        </div>
    </div>
        <div class="row w-100 mt-1">
            <div class="col-2">Soggetti Collegati:</div>
            <div class="col-10">
                @if($v->subjects->count()!=0)
                <div class="it-list-wrapper w-100">
                    <ul class="it-list">
                    @foreach ($v->subjects as $s )
                    <li>
                    <a href="{{route('subject.show',['id'=>$s->id,'tab'=>3])}}" data-toggle="tooltip" title="{{$s->pivot->relationship}}">
                        <div class="it-right-zone">
                            <span>{{$s->pivot->relationship}}</span>
                            <span class="text-uppercase">{{$s->surname}}</span>
                            <span class="text-capitalize"> {{$s->name}}</span>
                            <span> {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-chevron-right"></use></svg>
                        </div>
                        </a>
                    </li>
                    @endforeach
                    </ul>
                </div>
                @else
                <p>Nessun Soggeto Collegato</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
