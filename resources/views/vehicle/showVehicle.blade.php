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


<div class="row border-bottom border-primary mt-5">
    <div class="col-9">
        <h5>Scheda Veicolo</h5>
    </div>
    <div class="col-3 text-right">
        <a href="{{route('vehicle.edit',$vehicle->id)}}" title="modifica">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg>
        </a>
    </div>
</div>
<div class="row mt-3">
    <div class="col-4">
        <span>Targa: </span><span>{{$vehicle->plate}}</span>
    </div>
    <div class="col-4">
        <span>Modello: </span><span>{{$vehicle->model}}</span>
    </div>
    <div class="col-4">
        <span>Colore: </span><span>{{$vehicle->color}}</span>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12" style="font-size:small">
        <span>Dato aggiornato il {{$vehicle->updated_at}} da {{$vehicle->updatedfrom}}</span>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <span>Note: </span><span>{{$vehicle->note}}</span>
    </div>
</div>
<div class="row mt-3">
    <div class="col-9">
        Soggetti Collegati:
    </div>
    <div class="col-3 text-right">
        <button title="Aggiungi Soggetto" class="btn" data-toggle="modal" data-target="#attachSubjectModal">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use></svg>
        </Button>
</div>
</div>
<div class="row">
    @foreach ($vehicle->subjects as $s )
        <div class="col-12 col-lg-4">
            <div class="card-wrapper card-space">
                <div class="card card-bg">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="text-uppecase">{{$s->surname}} </span>
                        <span class="text-capitalize">{{$s->name}} </span>
                        <span>{{date('d-m-Y',strtotime($s->birthdate))}}</span>
                    </h5>
                    <p class="card-text">{{$s->pivot->relationship}}</p>
                    <p class="card-text">Dato aggiornato il {{$s->pivot->updated_at}}</p>
                    <p class="card-text">da {{$s->pivot->updatedfrom}}</p>
                    <a class="simple-link" href="{{route('subject.show',['id'=>$s->id,'tab'=>1])}}">vedi...</a>
                </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="modal" tabindex="-1" role="dialog" id="attachSubjectModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Cerca Soggetto da Inserire per Cognome
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{route('vehicle.findsubject',$vehicle->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                      {{-- <label for="surname">Cognome:</label> --}}
                      <input type="text" class="form-control" name="surname" id="surname" aria-describedby="helpId">
                      <small id="helpId" class="form-text text-muted">Cognome(usare % come carattere jolly)</small>
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
