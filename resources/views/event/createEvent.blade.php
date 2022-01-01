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
    <div class="col-xl border-bottom border-primary">
    <h5>Nuovo Evento</h5>
    </div>
</div>

<div class="row mt-5">
    <div class="col-xl-12">
    <form action="{{route('event.store')}}" method="POST">
        @csrf
    <div class="form-row">
        <div class="form-group col-xl-12">
            <input type="text" class="form-control" name="description" id="description">
            <label for="description">Descrizione</label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xl-12">
            <input type="date" name="dateevent" id="dateevent" placeholder="inserisci una data in formato gg/mm/aaaa" class="form-control">
            <p style="font-size:small;">Data Evento</p>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xl-12">
        <textarea name="note" id="note" cols="30" rows="5"></textarea>
        <label for="note">Note</label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xl-12">
            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
            <a href="{{route('event.index')}}" class="btn btn-outline-primary btn-sm">Annulla</a>
        </div>
    </div>
    </form>
    </div>
</div>


@endsection


