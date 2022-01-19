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
    <h6>Modifica Partecipanti Evento ajax- <a href="{{route('event.show',$event->id)}}">{{$event->description}} del {{date('d/m/Y',strtotime($event->dateevent))}}</a></h6>
    </div>
</div>

<div class="row mt-3 ">
    <div class="col-5 shadow p-3 mb-1 bg-white">
        <p>Elenco Soggetti Trovati nel Database</p>
        <p class="border-bottom" style="font-size:small">(Clicca sul nome per aggiungerlo tra i partecipanti)</p>

    </div>
    <div class="col-2">
    </div>
    <div class="col-5 shadow p-3 mb-1 bg-white">
        <p>Elenco Partecipanti o Soggetti legati all'evento</p>
        <p class="border-bottom" style="font-size:small">(Clicca sul nominativo per eliminarlo dall'elenco)</p>

    </div>
</div>

<div class="row mt-1 ">
    <div class="col-5 shadow p-3 mb-5 bg-white" style="height:550px;overflow:auto" id="leftdiv">
        @foreach ($subjects as $s)
        @if(null==$event->subjects()->find($s->id))
            <div id="{{$s->id}}" class="chip chip-lg chipleft w-100 chip-secondary" data-route="{{route('event.attacheventsubject',[$event->id,$s->id])}}">
                <span class="chip-label" style="font-size:small;">
                    <span class="text-uppercase">{{$s->surname}}</span>
                    <span class="text-capitalize"> {{$s->name}} </span>
                    <span> - {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                </span>
            </div>
        @else
            <div id="{{$s->id}}" class="chip chip-lg chipleft w-100 chip-danger" style="display:none" data-url="{{route('event.attacheventsubject',[$event->id,$s->id])}}">
                <span class="chip-label" style="font-size:small;">
                    <span class="text-uppercase">{{$s->surname}}</span>
                    <span class="text-capitalize"> {{$s->name}} </span>
                    <span> - {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                </span>
            </div>
        @endif
        @endforeach
    </div>
        <div class="col-2 text-center" style="height:550px;padding-top:200px">
        <svg class="icon icon-xl icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-exchange-circle"></use></svg>
    </div>
    <div class="col-5 shadow p-3 mb-5 bg-white" style="height:550px;overflow:auto" id="rightdiv">
        @foreach ($subjects as $s)
        @if(null==$event->subjects()->find($s->id))
            <div id="{{$s->id}}" class="chip chip-lg chipright w-100 chip-success" style="display:none" data-route="{{route('event.detacheventsubject',[$event->id,$s->id])}}">
                <span class="chip-label" style="font-size:small;">
                    <span class="text-uppercase">{{$s->surname}}</span>
                    <span class="text-capitalize"> {{$s->name}} </span>
                    <span> - {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                </span>
            </div>
        @else
            <div id="{{$s->id}}" class="chip chip-lg chipright w-100 chip-success" data-route="{{route('event.detacheventsubject',[$event->id,$s->id])}}">
                <span class="chip-label" style="font-size:small;">
                    <span class="text-uppercase">{{$s->surname}}</span>
                    <span class="text-capitalize"> {{$s->name}} </span>
                    <span> - {{date('d/m/Y',strtotime($s->birthdate))}}</span>
                </span>
            </div>
        @endif
        @endforeach
    </div>
</div>

@endsection

@section('javascript')

<script type="text/javascript">

$('div .chipleft').click(function(e){
    var id = $(this).attr('id');
    $.ajax({
        url:$(this).data('route'),
        dataType:'json',
        success:function(result){
        },
    });
    $(this).toggle();
    $("#rightdiv").children("#"+id).show();
});

$('div .chipright').click(function(e){
    var id = $(this).attr('id');
    $.ajax({
        url:$(this).data('route'),
        dataType:'json',
        success:function(result){

        },
    });
    $(this).toggle();
    $("#leftdiv").children("#"+id).show();
});



</script>

@endsection
