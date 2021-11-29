@extends('base')

@section('content')

{{-- messaggio errori --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12 bg-primary text-white mt-3">
    <h5>Inserimento Nuovo Contatto</h5>
</div>

<div class="col-12 mt-5">
   <form action="{{route('contact.store')}}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{$subject->id}}">
        <div class="form-row">
            <div class="col-12 form-group">
                <input type="text"  class="form-control" name="contact" id="contact" placeholder="inserire Nr. telefono,email,account social">
                <label for="contact">contatto</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
            <div class="bootstrap-select-wrapper">
                <label>Tipologia contatto</label>
                <select class="form-control" name="contacttype" id="contacttype" title="Scegli un'opzione">
                    <option value="TELEFONO">TELEFONO</option>
                    <option value="EMAIL">EMAIL</option>
                    <option value="SOCIAL">SOCIAL</option>
                    <option value="WEB">WEB</option>
                    <option value="ALTRO">ALTRO</option>
                </select>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
            <input class="form-control" type="text" name="relationship" id="relationship" placeholder="Inserire ad es. Utilizzatore,intestatario ...">
            <label for="relationship">Tipo di Relazione con il Soggetto</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
                <textarea name="note" id="note" cols="30" rows="4"></textarea>
                <label for="note">Note</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col text-right">
                <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                <a href="{{route('subject.show',['id'=>$subject->id,'tab'=>2])}}" class="btn btn-outline-primary btn-sm">Annulla</a>
            </div>

        </div>


    </form>
</div>

@endsection
