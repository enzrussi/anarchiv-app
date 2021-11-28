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

<div>
  <ul class="nav nav-tabs nav-tabs-icon-text" id="myTab3" role="tablist">
    <li class="nav-item">
      <a class="nav-link {{session('tab')==1 || session('tab')==null? 'active':null}}" id="tab1c-tab" data-toggle="tab" href="#tab1b" role="tab" aria-controls="tab1b"
       aria-selected="{{session('tab')==1 || session('tab')==null?'true':'false'}}">
        <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Dati Anagrafici
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{session('tab')==2?'active':null}}" id="tab2b-tab" data-toggle="tab" href="#tab2b" role="tab" aria-controls="tab2b"
      aria-selected="{{session('tab')==2?'true':'false'}}">
       <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Contatti
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="tab3b-tab" data-toggle="tab" href="#tab3b" role="tab" aria-controls="tab3b" aria-selected="false">
        <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Veicoli
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="tab4b-tab" data-toggle="tab" href="#tab4b" role="tab" aria-controls="tab4b" aria-selected="false" aria-disabled="true" tabindex="-1">
        <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Luoghi
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="tab5b-tab" data-toggle="tab" href="#tab5b" role="tab" aria-controls="tab5b" aria-selected="false" aria-disabled="true" tabindex="-1">
        <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Note
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="tab6b-tab" data-toggle="tab" href="#tab6b" role="tab" aria-controls="tab6b" aria-selected="false" aria-disabled="true" tabindex="-1">
        <svg class="icon icon-primary"><use xlink:href="{{asset('svg/sprite.svg')}}#it-link"></use></svg> Foto
      </a>
    </li>
  </ul>

  <div class="tab-content" id="myTab3Content">
    {{-- anagraphic  --}}
    <div class="tab-pane p-4 fade {{session('tab')==1 || session('tab')==null ? 'show active':null}}" id="tab1b" role="tabpanel" aria-labelledby="tab1c-tab">
      <div class="row">
        <div class="col-8 col-lg-8">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title bg-primary text-white pl-2">Dati Anagrafici</h5>
                <p class="card-text text-sans-serif">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Cognome:</td><td><p class="text-uppercase font-weight-bold">{{$subject->surname}}</p></td><td>Nome:</td><td><p class="text-capitalize font-weight-bold">{{$subject->name}}</p></td>
                            </tr>
                            <tr>
                                <td>Data di Nascita:</td><td>{{$subject->birthdate}}</td><td>Luogo di nascita:</td><td>{{$subject->placebirth}}</td>
                            </tr>
                            <tr>
                                <td>Codice CUI:</td><td>{{$subject->cuicode}}</td><td>Codice Fiscale:</td><td>{{$subject->fiscalcode}}</td>
                            </tr>
                            <tr>
                                <td>Soprannome:</td><td colspan="3">{{$subject->nickname}}</td>
                            </tr>
                            <tr><td>Ultimo Aggiornamento:</td><td>{{$subject->updated_at}}</td><td>Operatore:</td><td>{{$subject->updatedfrom}}</td></tr>
                            <tr><td colspan="4"><button><svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg></button></td></tr>
                            <tr><td><p>Gruppi</p>
                            <p style="font-size:x-small">(cliccare per eliminare)</p>
                            </td><td colspan="4">
                            @foreach ($subject->groups as $group )
                            <div  class="chip chip-primary chip-lg">
                              <a href="{{route('subject.detachgroup',['id' => $subject->id, 'group_id' => $group->id])}}">
                              <span class="chip-label">{{$group->groupname}}</span>
                              </a>
                            </div>
                            @endforeach
                            </td></tr>
                            <tr><td><div class="align-middle"><p>Aggiungi gruppo</p>
                            <p style="font-size:x-small">(cliccare per aggiungere)</p>
                            </div>
                            </td>

                            <td colspan="3">
                            @foreach ($groups as $group)
                            @if(null == $subject->groups()->find($group->id))
                            <div class="chip chip-secondary chip-lg">
                                <a href="{{route('subject.attachgroup',['id'=>$subject->id,'group_id'=>$group->id])}}">
                                <span class="chip-label">{{$group->groupname}}</span></a>
                              </div>
                            @endif
                            @endforeach
                            </td></tr>
                        </tbody>
                    </table>

                </p>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>

        <div class="col-4 col-lg-4 ">
            <!--start card-->
            <div class="card-wrapper">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Foto</h5>
                  <p class="card-text"><img src="{{asset('svg/logo_welcome_polizia.jpg')}}" class="img-thumbnail" alt="IMMAGINE PREDEFINITA"></p>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
      </div>
    </div>
    {{-- Contact --}}
    <div class="tab-pane p-4 fade {{session('tab')==2? 'show active':null}}" id="tab2b" role="tabpanel" aria-labelledby="tab2b-tab">

            {{-- header tab --}}
            <div class="row mb-3">
            <div class="col-8 border-bottom bg-primary text-white">
            <span class="text-uppercase font-weight-bold">{{$subject->surname}} </span>
            <span class="text-capitalize font-weight-bold">{{$subject->name}} </span>
            <span> nato a </span><span class="text-capitalize">{{$subject->placebirth}} </span>
            <span> in data </span><span>{{$subject->birthdate}}</span>
            </div>
            <div class="col-4 text-right"><a class="btn btn-primary btn-sm" href="{{route('contact.create',$subject->id)}}">Inserisci Nuovo</a></div>
        </div>

        {{-- content tab --}}

        @foreach ($subject->contacts as $c )

                <div class="row shadow p-3 mb-5 bg-white ">
                        <div class="col-8 ">
                        <p><span class="font-weight-bold">{{$c->contacttype}}: {{$c->contact}}</span>
                            <span> tipo di relazione: {{$c->relationship}}</span></p>
                            <p>
                            <span style="font-size: small;"> dato aggiornato il {{$c->updated_at}} da {{$c->updatedfrom}} </span>
                        </p>
                        <p><span class="text-justify">Note: {{$c->note}}</span></p>
                        </div>
                        <div class="text-right col-4"><a class="btn btn-sm" href="{{route('contact.edit',$c->id)}}">
                            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg>
                        </a>
                        <button type="button" class="btn" data-toggle="modal" data-target="#confirmDeleteContactModal{{$c->id}}">
                            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
                        </button>
                        </div>
                    </div>
            {{--  Confirm delete contact Modal--}}
                    <div class="it-example-modal">
                        <div class="modal" tabindex="-1" role="dialog" id="confirmDeleteContactModal{{$c->id}}">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Conferma Eliminazione Contatto
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <p>Sei sicuro di voler eliminare il contatto?.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                                    <form action="{{route('contact.destroy',$c->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn  btn-primary btn-sm">OK</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
            @endforeach
    </div>
    {{-- Veicles --}}
    <div class="tab-pane p-4 fade" id="tab3b" role="tabpanel" aria-labelledby="tab3b-tab"><p>Contenuto 3</p></div>
    <div class="tab-pane p-4 fade" id="tab4b" role="tabpanel" aria-labelledby="tab4b-tab">Contenuto 4</div>
  </div>
</div>
{{--  windows Modal --}}



@endsection
