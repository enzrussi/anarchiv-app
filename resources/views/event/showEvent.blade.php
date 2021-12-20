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

<div class="row mt-5">
    <div class="col-xl-8 border-bottom border-primary">
        <h5>{{$event->description}} - {{$event->dateevent}}</h5>
    </div>
    <div class="col-xl-4 border-bottom border-primary text-right">
        <a href="{{route('event.edit',$event->id)}}" class="btn btn-sm">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg>
        </a>
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#confirmDeleteEventModal">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 mt-3" style="font-size:x-small">dato aggiornato il {{$event->updated_at}} da {{$event->updatedfrom}}</div>
</div>
<div class="row">
    <div class="col-xl-12 text-justify">{{$event->note}}</div>
</div>
<div id="collapseDiv" class="collapse-div mt-5" role="tablist">
    <div id="heading1" class="collapse-header">
        <button data-toggle="collapse" data-target="collapse1" aria-expanded="true" aria-controls="collapse1">
            Partecipanti
        </button>
    </div>
    <div id="collapse1" role="tabpanel" class="collapse" aria-labelledby="heading1">
        <div class="collapse-body">
            @foreach ($event->subjects as $s )
            <div class="chip">
                <svg class="icon icon-xs"><use xlink:href="{{asset('photo')}}/{{$s->photo}})}}"></use></svg>
                <span class="chip-label">
                    <a href="{{route('subject.show',['id'=>$s->id,'tab'=>1])}}">
                    <span class="text-uppercase">{{$s->surname}}</span><span class="text-capitalize"> {{$s->name}} </span><span> - {{$s->birthdate}}</span>
                    </a>
                </span>
            </div>
            @endforeach
        </div>
    </div>
    <div id="heading2" class="collapse-header">
        <button data-toggle="collapse" data-target="collapse2" aria-expanded="true" aria-controls="collpase2">
            Documentazione
        </button>
    </div>
    <div id="collapse2" role="tabpanel" class="collapse" aria-labelledby="heading2">ù
        <div class="collapse-body">
            {{-- @foreach($event->documents as $d)

            @endforeach --}}
        </div>
    </div>
</div>


{{-- MODALS --}}

<div class="it-example-modal">
    <div class="modal" tabindex="-1" role="dialog" id="confirmDeleteEventModal">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Conferma Eliminazione Evento
                </h5>
             </div>
             <div class="modal-body">
                <p>Confermi di voler eliminare l'evento?</p><p class="font-weight-bold">(procedura irreversibile...)</p>
             </div>
             <div class="modal-footer">
                <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                <form action="{{route('event.destroy',$event->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary btn-sm" type="submit">Conferma</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>



@endsection
