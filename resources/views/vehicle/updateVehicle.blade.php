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

    <div class="bg-primary text-white mb-3 mt-5 p-2">
        <h5>Inserimento Nuovo Veicolo</h5>
    </div>
    <div class="mt-5">
        <form action="{{route('vehicle.update',$vehicle->id)}}" method="POST">
            @csrf
            @method('PUT')
        <div class="form-row">
        <div class="form-group col-3">
            <input type="text" class="form-control" name="plate" id="plate" value="{{$vehicle->plate}}">
            <label for="plate">Targa</label>
        </div>
        <div class="form-group col-3">
            <input type="text" class="form-control" name="model" id="model"value="{{$vehicle->model}}">
            <label for="Model">Modello</label>
        </div>
        <div class="form-group col-3">
            <input type="text" class="form-control" name="color" id="color" value="{{$vehicle->color}}">
            <label for="color">Colore</label>
        </div>
        <div class="form-group col-3">
            <input type="text" class="form-control" name="relationship" id="relationship"
            placeholder="Intestatario, utilizzatore ..." value="{{$vehicle->relationship}}">
            <label for="relationship">Relazione</label>
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <textarea name="note" id="note" cols="30" rows="5">{{$vehicle->note}}</textarea>
                <label for="note">Note</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary">Salva</button>
                <a href="{{route("subject.show",['id'=>$vehicle->subject_id,'tab'=>3])}}" class="btn btn-outline-primary">Annulla</a>
            </div>
        </div>
        </form>
    </div>


@endsection

