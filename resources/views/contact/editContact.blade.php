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
<span><h6>Modifica Contatto</h6></span>
</div>

<div class="col-12 mt-5">
<form action="{{route('contact.update',$contact->id)}}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{$contact->id}}">
        <div class="form-row">
            <div class="col-12 form-group">
                <input type="text"  class="form-control" name="contact" id="contact"
                value="{{$contact->contact}}">
                <label for="contact">contatto</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
            <div class="bootstrap-select-wrapper">
                <label>Tipologia contatto</label>
                <select class="form-control" name="contacttype" id="contacttype" title="Scegli un'opzione">
                    <option value="TELEFONO" {{$contact->contacttype=='TELEFONO'? "selected" : null}}>TELEFONO</option>
                    <option value="EMAIL" {{$contact->contacttype=='EMAIL'? "selected" : null}}>EMAIL</option>
                    <option value="SOCIAL" {{$contact->contacttype=='SOCIAL'? "selected" : null}}>SOCIAL</option>
                    <option value="WEB" {{$contact->contacttype=='WEB'? "selected" : null}}>WEB</option>
                    <option value="ALTRO" {{$contact->contacttype=='ALTRO'? "selected" : null}}>ALTRO</option>
                </select>
            </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
                <div class="bootstrap-select-wrapper">
                    <label>Tipo Relazione</label>
                    <select class="form-control" name="relationship" id="relationship" title="Scegli un'opzione">
                        @foreach (array('INTESTATARIO','UTILIZZATORE','ALTRO') as $r)
                            @if($r == $contact->relationship)
                            <option value="{{$r}}" selected>{{$r}}</option>
                            @else
                            <option value="{{$r}}">{{$r}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
                <textarea name="note" id="note" cols="30" rows="4">{{$contact->note}}</textarea>
                <label for="note">Note</label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col text-right">
                <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                <a href="{{route('subject.show',['id'=>$contact->subject_id,'tab'=>2])}}" class="btn btn-outline-primary btn-sm">Annulla</a>
            </div>

        </div>
    </div>

</form>








@endsection
