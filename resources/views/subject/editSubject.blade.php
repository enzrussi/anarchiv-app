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

<div class="row col-12 mt-5">
    <div class="col-12 bg-primary text-white">
        <h5>Modifica Dati Soggetto</h5>
    </div>
<div class="row col-12 align-center" aria-hidden="true">
<form action="{{route('subject.update',$subject->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-row col-12 mt-5">
        <div class="form-group col-4">
            <input type="text" name="surname" id="surname" value="{{$subject->surname}}">
            <label for="surname">Cognome</label>
        </div>
        <div class="form-group col-4">
            <input type="text" name="name" id="name" value="{{$subject->name}}">
            <label for="name">Nome</label>
        </div>
        <div class="form-group col-4">
            <input type="text" name="nickname" id="nickname" value="{{$subject->nickname}}" placeholder="soprannome">
            <label for="nickname">Soprannome</label>
        </div>
   </div>
    <div class="form-row col-12 mt-5 ">
        <div class="form-group col-4">
            {{-- <input type="date" class="form-control" name="birthdate" id="birthdate"
            value="{{date('d/m/Y',strtotime($subject->birthdate))}}" placeholder="inserisci la data in formato gg/mm/aaaa"> --}}
            <input type="date" class="form-control" name="birthdate" id="birthdate"
            value="{{$subject->birthdate}}" placeholder="inserisci la data in formato gg/mm/aaaa">
            <p style="font-size:small">Data di Nascita</p>
        </div>
        <div class="form-group col-4">
            <input type="text" name="placebirth" id="placebirth" value="{{$subject->placebirth}}">
            <label for="placebirth">Luogo di Nascita</label>
        </div>
        <div class="form-group col-4">
            <input type="text" name="cuicode" id="cuicode" value="{{$subject->cuicode}}" placeholder="Codice Cui">
            <label for="cuicode">Codice CUI</label>
        </div>
   </div>
   <div class="form-row col-12">
    <div class="form-group col-6">
        <input type="text" name="fiscalcode" id="fiscalcode" value="{{$subject->fiscalcode}}" placeholder="Codice Fiscale">
        <label for="fiscalcode">Codice Fiscale</label>
    </div>
    </div>
    <div class="form-row col-12">
        <div class="form-group col-6">
            <a class="btn btn-outline-primary btn-sm" href="{{route('subject.show',['id'=>$subject->id,'tab'=>1])}}">Annulla</a>
            <button type="submit" class="btn btn-primary btn-sm">Salva</button>
        </div>
        </div>


</form>
</div>
</div>

@endsection
