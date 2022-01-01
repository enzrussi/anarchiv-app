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

<div class="row">
    <div class="col-12 border-bottom border-primary mt-5">
    <h6>Modifica Partecipanti Evento - <a href="{{route('event.show',$event->id)}}">{{$event->description}} del {{date('d/m/Y',strtotime($event->dateevent))}}</a></h6>
    </div>
</div>

<div class="row mt-3">
    <div class="col-5">
        <p>Elenco Soggetti nel Database</p>
        <p class="border-bottom" style="font-size:small">(Clicca sul nome per aggiungerlo tra i partecipanti)</p>

    </div>
    <div class="col-2">
    </div>
    <div class="col-5">
        <p>Elenco Partecipanti o Soggetti legati all'evento</p>
        <p class="border-bottom" style="font-size:small">(Clicca sul nominativo per eliminarlo dall'elenco)</p>

    </div>
</div>

<div class="row mt-3">
    <div class="col-5" style="height:550px;overflow:auto">
        @foreach ($subjects as $s)
        @if(null==$event->subjects()->find($s->id))
        <p>
        <a href="{{route('event.attacheventsubject',[$event->id,$s->id])}}">
            @if(null==$s->photo)
                <svg class="icon icon-sm"><use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use></svg>
                @else
                <div class="avatar size-lg"><img src="{{asset('photo')}}/{{$s->photo}}"></div>
                @endif
            <span class="text-uppercase">{{$s->surname}}</span><span class="text-capitalize"> {{$s->name}} </span><span> - {{$s->birthdate}}</span>
        </a>
        </p>
        @endif
        @endforeach
    </div>
    <div class="col-2 text-center" style="height:500px;padding-top:200px">
        <svg class="icon icon-xl icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-exchange-circle"></use></svg>
    </div>
    <div class="col-5" style="height:500px;overflow:auto">
        @foreach ($event->subjects->sortBy(['surname','name']) as $es)
        <p>
                <a href="{{route('event.detacheventsubject',[$event->id,$es->id])}}">
                @if(null==$es->photo)
                <svg class="icon icon-sm"><use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use></svg>
                @else
                <div class="avatar size-lg"><img src="{{asset('photo')}}/{{$es->photo}}"></div>
                @endif
                <span class="text-uppercase">{{$es->surname}}</span><span class="text-capitalize"> {{$es->name}} </span><span> - {{$es->birthdate}}</span>
                </a>
            </span>
        </p>
        @endforeach
    </div>
</div>

@endsection
