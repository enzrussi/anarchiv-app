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

<div class="row border-bottom mt-3">
    <div class="col-10">
        <h5>Gestione Gruppo {{$group->groupname}}</h5>
    </div>
    <div class="col-2 text-right">
        <a href="{{route('group.listgroup')}}">
            <svg class="icon icon-lg">
                <use xlink:href="{{asset('svg/sprite.svg')}}#it-arrow-left-circle"></use>
            </svg>
        </a>
    </div>
</div>

<div class="row mt-3">
    <div class="col-5">
        <div class="row">
            <div class="col border-bottom">
                <h6>Soggetti nel Database</h6>
            </div>
        </div>
        <div class="row">
            <div class="col" style="font-size:small">
                Cliccare sul nome per aggiungerlo al gruppo
            </div>
        </div>
        <div class="row mt-3">
            <div id="divleft" class="col" style="overflow-y:scroll; height:550px;">
                @foreach($subjects->sortBy(['surname','name']) as $s)
                    @if(null==$group->subjects()->find($s->id))
                        <div id="{{$s->id}}" data-route="{{route('group.attachsubject',['id'=>$group->id,'subject_id'=>$s->id])}}"
                            class="attachsubject chip mb-1 chip-secondary" style="width:90%">
                            <div class="chip-label">
                                <span>{{$s->surname}} </span>
                                <span>{{$s->name}} </span>
                                <span>{{$s->birthdate}}</span>
                            </div>
                        </div>
                    @else
                        <div id="{{$s->id}}" data-route="{{route('group.attachsubject',['id'=>$group->id,'subject_id'=>$s->id])}}"
                            class="attachsubject chip w-75 mb-1 chip-secondary" style="display:none;width:90%">
                            <div class="chip-label">
                                <span>{{$s->surname}} </span>
                                <span>{{$s->name}} </span>
                                <span>{{$s->birthdate}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-2">

    </div>
    <div class="col-5">
        <div class="row">
            <div class="col border-bottom"><h6>Soggetti affiliati al Gruppo</h6></div>
        </div>
        <div class="row">
            <div class="col" style="font-size:small">Clicca sul nominativo per toglierlo dal Gruppo</div>
        </div>
        <div class="row mt-3">
            <div id="divright" class="col"  style="overflow-y:scroll; height:550px;">
                @foreach ($subjects->sortBy(['surname','name']) as $gs)
                @if(null!=$group->subjects()->find($gs->id))
                        <div id="{{$gs->id}}" data-route="{{route('group.detachsubject',['id'=>$group->id,'subject_id'=>$gs->id])}}"
                            class="detachsubject chip mb-1 chip-primary" style="width:90%;">
                            <div class="chip-label">
                                <span>{{$gs->surname}} </span>
                                <span>{{$gs->name}} </span>
                                <span>{{$gs->birthdate}}</span>
                            </div>
                        </div>
                    @else
                        <div id="{{$gs->id}}" data-route="{{route('group.detachsubject',['id'=>$group->id,'subject_id'=>$gs->id])}}"
                            class="detachsubject chip mb-1 chip-primary" style="display:none; width:90%">
                            <div class="chip-label">
                                <span>{{$gs->surname}} </span>
                                <span>{{$gs->name}} </span>
                                <span>{{$gs->birthdate}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script type="text/javascript">

$('div.attachsubject').click(function(){
    var id = $(this).attr('id');
    $.ajax({
        url:$(this).data('route'),
        datatype:'json',
        success:function(result){

        },
    });
    $(this).toggle();
    $('#divright').children('#'+id).show();
});

$('div.detachsubject').click(function(){
    var id = $(this).attr('id');
    $.ajax({
        url:$(this).data('route'),
        datatype:'json',
        success:function(result){

        },
    });
    $(this).toggle();
    $('#divleft').children('#'+id).show();
});



</script>

@endsection
