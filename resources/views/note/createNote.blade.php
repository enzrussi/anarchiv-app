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
        <h5>Inserimento Nuova Nota</h5>
    </div>

<div class="col-12 mt-5">
    <form action="{{route('note.store')}}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{$id}}">
        <div class="form-row ">
            <div class="form-group col-12">
                <input type="text" name="description" id="description" class="form-control">
                <label for="description">Descrizione</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12">
            <textarea name="note" id="note" cols="30" rows="10"></textarea>
            <label for="note">Note</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary">Salva</button>
                <a href="{{route('subject.show',['id'=>$id,'tab'=>5])}}" class="btn btn-outline-primary">Annulla</a>
            </div>
        </div>

    </form>
</div>

@endsection
