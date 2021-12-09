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

    <div class="row mb-3 mt-3">
        <div class="col-8 border-bottom bg-primary text-white">
            <a href="{{route('subject.show',['id'=>$photo->subject->id,'tab'=>1])}}" class="text-white" title="Torna alla scheda del soggetto">
            <div class="avatar size-xl"><img src="{{asset('photo').'/'.$photo->subject->photo}}" alt="??"></div>
            <span class="text-uppercase font-weight-bold">{{ $photo->subject->surname }} </span>
            <span class="text-capitalize font-weight-bold">{{ $photo->subject->name }} </span>
            <span> nato a </span><span class="text-capitalize">{{ $photo->subject->placebirth }} </span>
            <span> in data </span><span>{{ $photo->subject->birthdate }}</span>
            </a>
        </div>
        <div class="col-4 text-right">
            <a class="btn btn-primary btn-sm text-white" href="{{route('photo.index',$photo->subject_id)}}" title="Torna alla pagina precedente">
                <svg class="bg-primary icon icon-white align-bottom">
                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-arrow-left-circle"></use>
                </svg>
            </a>
            @if($photo->url != $photo->subject->photo)
            <a class="btn btn-primary btn-sm text-white" href="{{route('photo.updatephotosubject',$photo->id)}}" title="Seleziona come Foto principale">
                <svg class="bg-primary icon icon-white align-bottom">
                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use>
                </svg>
            </a>
            @endif
            <button class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#updatePhotoModal" title="Modifica i dati della Foto">
                <svg class="bg-primary icon icon-white align-bottom">
                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use>
                </svg>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#deletePhotoModal" title="Elimina la foto">
                <svg class="bg-primary icon icon-white align-bottom">
                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use>
                </svg>
            </button>
        </div>
    </div>

    <div class="row col-12">
        <div class="col-8">
        <figure class="figure">
            <img src="{{asset('photo').'/'.$photo->url}}" class="figure-img img-fluid rounded"
            alt="immagine non trovata">
            <figcaption class="figure-caption">{{$photo->url}}</figcaption>
          </figure>
        </div>
        <div class="col-4">
            <p class="font-weight-bold">{{$photo->description}}</p>
            <p>Aggiornata il {{$photo->updated_at}} da {{$photo->updatedfrom}}</p>
            <p>{{$photo->note}}</p>
        </div>

    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="deletePhotoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Conferma Eliminazione Foto</h5>
                </div>
                <div class="modal-body">
                    <p>Confermi di voler eliminare definitvamente la foto?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                    <form action="{{route('photo.destroy',['id'=>$photo->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="btn btn-primary btn-sm" type="submit">Elimina Foto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Update --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="updatePhotoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('photo.update',$photo->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="subject_id" value="{{$photo->subject_id}}">
                <div class="modal-header">
                    <h5>Modifica Dati Foto</h5>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="description" id="description" value="{{$photo->description}}">
                            <label for="description">Descrizione</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="note" id="note" value="{{$photo->note}}">
                            <label for="note"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                    <button class="btn  btn-primary btn-sm" type="submit">Salva</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection
