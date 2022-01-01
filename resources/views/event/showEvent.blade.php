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
    <div class="col-xl-8 border-bottom border-primary font-weight-bold text-primary">
        <h5>{{$event->description}} - {{date('d/m/Y',strtotime($event->dateevent))}}</h5>
    </div>
    <div class="col-xl-4 border-bottom border-primary text-right">
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#updateEventModal">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg>
        </button>
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#confirmDeleteEventModal">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
        </button>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 mt-3" style="font-size:x-small">dato aggiornato il {{$event->updated_at}} da {{$event->updatedfrom}}</div>
</div>
<div class="row">
    <div class="col-xl-12 text-justify">{{$event->note}}</div>
</div>

{{-- area collapse --}}
<div class="collapse-div col-12 mt-5" id="collpasediv1" role="tablist">

{{-- documentazione --}}

    <div class="collapse-header text-primary" data-toggle="collapse" data-target="#collpase1" aria-expanded="true" aria-controls="collapse1" >
        <button data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
            Documentazione <span class="badge badge-light">{{$event->documents->count()}}</span>
        </button>
    </div>
    <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="heading1">
        <div class="collapse-body">
            <div class="row mt-3">
                <div class="col-10 border-bottom border-primary text-danger">
                    <h5>Documentazione</h6>
                </div>
                <div class="col-2 border-bottom border-primary text-right">
                    <button class="btn btn-sm" data-toggle="modal" data-target="#createDocumentModal">
                        <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use></svg>
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descrizione</th>
                                <th>Data Documentazione</th>
                                <th>Note</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->documents as $d )
                            <tr>
                                <td>{{$d->description}}</td>
                                <td>{{date('d/m/Y',strtotime($d->datedocument))}}</td>
                                <td>
                                    <p>{{$d->note}}</p>
                                    <p style="font-size:small">Dato aggiornato il {{$d->updated_at}} da {{$d->updatedfrom}}</p>
                                </td>
                                <td class="text-right">
                                    <button typp="button" class="btn btn-sm" data-toggle="modal" data-target="#updateDocumentModal{{$d->id}}"><svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg></button>
                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#destroyDocumentModal{{$d->id}}">
                                        <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Update Document -->

                            <div class="modal" tabindex="-1" role="dialog" id="updateDocumentModal{{$d->id}}">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            MODIFICA RIFERIMENTO DOCUMENTALE
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('document.update',$d->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <p style="font-size:small" class="text-weight-bold">Descrizione</p>
                                                    <input type="text" name="description" id="description" class="form-control" value="{{$d->description}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <p style="font-size:small" class="text-weight-bold">Data Documento</p>
                                                    <p></p>
                                                    <input type="date" name="datedocument" id="datedocument" value="{{$d->datedocument}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <p style="font-size:small" class="text-weight-bold">Note</p>
                                                    <textarea cols="30" rows="5" name="note" id="note">{{$d->note}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">Salva</button>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-dismiss="modal">Annulla</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Modal Destroy Document -->

                                    <div class="modal" tabindex="-1" role="dialog" id="destroyDocumentModal{{$d->id}}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Conferma Eliminazione Documento
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('document.destroy',$d->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                        <p>Conferma la cancellazione del Riferimento Documentale?</p>
                                                        <p>(Procedura irreversibile...)</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <button type="submit" class="btn btn-primary btn-sm">Conferma</button>
                                                            <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Annulla</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>



{{-- partecipanti --}}

    <div class="collapse-header text-primary" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
        <button data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            Partecipanti <span class="badge badge-light">{{$event->subjects->count()}}</span>
        </button>
        <div class="collapse" id="collapse2" role="tabpanel" aria-labelledby="heading2">

            <div class="row mt-3">
                <div class="col-10 border-bottom border-primary text-success">
                    <h5>Partecipanti</h6>
                </div>
                <div class="col-2 border-bottom border-primary text-right">
                    <a class="btn btn-sm" href="{{route('event.editeventsubject',$event->id)}}">
                        <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @foreach ($event->subjects as $s )
                    <div class="chip">
                        <svg class="icon icon-xs"><use xlink:href="{{asset('photo')}}/{{$s->photo}})}}"></use></svg>
                        <span class="chip-label">
                            <a href="{{route('subject.show',['id'=>$s->id,'tab'=>1])}}">
                            <span class="text-uppercase">{{$s->surname}}</span><span class="text-capitalize"> {{$s->name}} </span><span> - {{$s->birthdate}}</span>
                            </a>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>


        </div>



    </div>

</div>











{{-- <div class="row mt-3">
    <div class="col-10 border-bottom border-primary text-danger">
        <h5>Documentazione</h6>
    </div>
    <div class="col-2 border-bottom border-primary text-right">
        <button class="btn btn-sm" data-toggle="modal" data-target="#createDocumentModal">
            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use></svg>
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Descrizione</th>
                    <th>Data Documentazione</th>
                    <th>Note</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->documents as $d )
                <tr>
                    <td>{{$d->description}}</td>
                    <td>{{date('d/m/Y',strtotime($d->datedocument))}}</td>
                    <td>
                        <p>{{$d->note}}</p>
                        <p style="font-size:small">Dato aggiornato il {{$d->updated_at}} da {{$d->updatedfrom}}</p>
                    </td>
                    <td class="text-right">
                        <button typp="button" class="btn btn-sm" data-toggle="modal" data-target="#updateDocumentModal{{$d->id}}"><svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-pencil"></use></svg></button>
                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#destroyDocumentModal{{$d->id}}">
                            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
                        </button>
                    </td>
                </tr>

                <!-- Modal Update Document -->

                <div class="modal" tabindex="-1" role="dialog" id="updateDocumentModal{{$d->id}}">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                MODIFICA RIFERIMENTO DOCUMENTALE
                            </div>
                            <div class="modal-body">
                                <form action="{{route('document.update',$d->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                <div class="form-row">
                                    <div class="form-group">
                                        <p style="font-size:small" class="text-weight-bold">Descrizione</p>
                                        <input type="text" name="description" id="description" class="form-control" value="{{$d->description}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <p style="font-size:small" class="text-weight-bold">Data Documento</p>
                                        <p></p>
                                        <input type="date" name="datedocument" id="datedocument" value="{{$d->datedocument}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <p style="font-size:small" class="text-weight-bold">Note</p>
                                        <textarea cols="30" rows="5" name="note" id="note">{{$d->note}}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary">Salva</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-dismiss="modal">Annulla</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Destroy Document -->

                        <div class="modal" tabindex="-1" role="dialog" id="destroyDocumentModal{{$d->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Conferma Eliminazione Documento
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('document.destroy',$d->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="form-row">
                                            <div class="form-group">
                                            <p>Conferma la cancellazione del Riferimento Documentale?</p>
                                            <p>(Procedura irreversibile...)</p>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <button type="submit" class="btn btn-primary btn-sm">Conferma</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Annulla</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                @endforeach
            </tbody>
        </table>

    </div>
</div> --}}




{{-- Modal Delete --}}

<div class="it-example-modal">
    <div class="modal" tabindex="-1" role="dialog" id="confirmDeleteEventModal">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Conferma Eliminazione Evento
                </h5>
             </div>
             <div class="modal-body">
                <p>Confermi di voler eliminare l'evento?</p><p class="font-weight-bold">(procedura irreversibile...)</p>
             </div>
             <div class="modal-footer">
                <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                <form action="{{route('event.destroy',$event->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary btn-sm" type="submit">Conferma</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>

  <!-- Modal Update-->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateEventModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Modifica Evento
          </h6>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <form action="{{route('event.update',$event->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-12">
                        <input type="text" class="form-control" name="description" id="description" value="{{$event->description}}">
                        <label for="description">Descrizione</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">

                        <div class="form-group">
                            <input type="date" class="form-controller" name="dateevent" id="dateevent" value="{{$event->dateevent}}"">
                            <p style="font-size:small">Data Evento</p>
                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="note" id="note" cols="30" rows="5">{{$event->note}}</textarea>
                            <label for="note">Note</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-primary btn-sm" type="submit">Salva</button>
                    <button class="btn btn-outline-primary btn-sm" data-dismiss="modal" type="button">Annulla</button>
                </div>
                </form>
                </div>

        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

<!-- Modal New Document -->
<div class="modal" tabindex="-1" role="dialog" id="createDocumentModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Inserire Nuovo Riferimento Documentale
            </div>
            <div class="modal-body">
                <form action="{{route('document.store')}}" method="post">
                @csrf
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="form-row">
                    <div class="form-group col-12">
                        <p style="font-size:small" class="text-wight-bold">Descrizione</p>
                        <input type="text" name="description" id="description" class="form-control" placeholder="max 150 lettere">
                    </div>
                </div>
                <div class="form-row">
                        <div class="form-group col-12">
                          <p style="font-size:small" class="text-wight-bold">Data Documento</p>
                          <input class="form-control" name="datedocument" type="date" placeholder="inserisci la data in formato gg/mm/aaaa">
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <p style="font-size:small" class="text-wight-bold">Note</p>
                        <input type="text" name="note" id="note" class="form-control" placeholder="max 255 caratteri">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Annulla</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>






@endsection
