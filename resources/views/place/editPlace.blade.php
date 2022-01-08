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

    <div class="col-12 bg-primary text-white mt-3">
        <h5>Inserimento Nuovo Luogo</h5>
    </div>

    <div class="col-12 mt-5">
        <form action="{{ route('place.update', $place->id) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="subject_id" value="{{ $place->id }}">
            <div class="form-row">
                <div class=" col-12 form-group">
                    <input type="text" name="name" id="name" placeholder="Descrizione del Luogo" value="{{$place->name}}">
                    <label for="name">Descrizione</label>
                </div>
            </div>
            <div class="form-row">
                <div class=" col-12 form-group">
                    <input type="text" name="address" id="address" placeholder="indirizzo" value="{{$place->address}}">
                    <label for="address">Indirizzo</label>
                </div>
            </div>
            <div class="form-row">
                <div class=" col-6 form-group">
                    <input type="text" name="city" id="city" placeholder="Città" value="{{$place->city}}">
                    <label for="city">Città</label>
                </div>
                <div class=" col-6 form-group">
                    <input type="text" name="zipcode" id="zipcode" placeholder="CAP" value="{{$place->zipcode}}">
                    <label for="zipcopde">CAP</label>
                </div>
            </div>
            <div class="form-row">
                <div class=" col-12 form-group">
                    <div class="bootstrap-select-wrapper">
                        <label>Tipo Relazione</label>
                        <select class="form-control" name="relationship" id="relationship" title="Scegli un'opzione">
                            <option value="RESIDENZA" @if($place->relationship == "RESIDENZA") selected @endif >RESIDENZA</option>
                            <option value="DOMICILIO"  @if($place->relationship == "DOMICILIO") selected @endif >DOMICILIO</option>
                            <option value="DOMICILIO OCCASIONALE"  @if($place->relationship == "DOMICILIO OCCASIONALE") selected @endif >DOMICILIO OCCASIONALE</option>
                            <option value="LAVORO"  @if($place->relationship == "LAVORO") selected @endif >LAVORO</option>
                            <option value="LAVORO OCCASIONALE"  @if($place->relationship == "LAVORO OCCASIONALE") selected @endif >LAVORO OCCASIONALE</option>
                            <option value="LAVORO STAGIONALE"  @if($place->relationship == "LAVORO STAGIONALE") selected @endif >LAVORO STAGIONALE</option>
                            <option value="SEDE DITTA" @if($place->relationship == "SEDE DITTA") selected @endif >SEDE DITTA</option>
                            <option value="ALTRO" @if($place->relationship == "ALTRO") selected @endif >ALTRO</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class=" col-12 form-group">
                    <textarea name="note" id="note" cols="30" rows="5" placeholder="Note">{{$place->note}}</textarea>
                    <label for="note">Note</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Salva</button>
                    <a href="{{ route('subject.show', ['id' => $place->subject_id, 'tab' => 4]) }}" class="btn btn-outline-primary">Annulla</a>
                </div>
            </div>
        </form>
    </div>



@endsection
