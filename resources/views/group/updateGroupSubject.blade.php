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
    <div class="col border-bottom mt-3">
        <p>Gestione Gruppo {{$group->groupname}}</p>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <h6>Soggetti nel Database</h6>
            </div>
        </div>
        <div class="row">
            <div id="divleft" class="col">
                @foreach($subjects->sortBy(['surname','name']) as $s)
                <div id="{{$s->id}}" data-route="{{route('group.attachsubject',['id'=>$group->id,'subject_id'=>$s->id])}}"
                    class="attachsubject">
                    <span>{{$s->surname}} </span><span>{{$s->name}} </span><span>{{$s->birthdate}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col">

    </div>
    <div class="col">
        <div class="row">
            <div class="col">Soggetti affiliati al Gruppo</div>
        </div>
        <div class="row">
            <div id="divright" class="col">
                @foreach ($group->subjects->sortBy(['surname','name']) as $gs)
                <div id="{{$s->id}}" data-route="{{route('group.detachsubject',['id'=>$group->id,'subject_id'=>$s->id])}}"
                    class='detachsubject'>
                    <span>{{$gs->surname}} </span><span>{{$gs->name}} </span><span> {{$gs->birthdate}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script type="text/javascript">

$('div.attachsubject').click(function(){
    alert($(this).data('route'));
});

$('div.detachsubject').click(function(){
    alert($(this).data('route'));
});



</script>

@endsection
