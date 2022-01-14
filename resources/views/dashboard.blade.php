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


<div class="row mt-5">
    <div class="col-12 col-lg-6">
      <!--start card-->
      <div class="card-wrapper">
        <div class="card">
          <div class="card-body">
            <div class="categoryicon-top">
              <svg class="icon">
                <use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use>
              </svg>
              <span class="text text-primary border-bottom">Soggetti - Veicoli</span>
            </div>
            <div class="mb-5">
                <p class="Card-text">Clicca per accedere alle funzionalità</p>
                <p><h5 class="card-title">Database di soggetti attenzionati dall'attività</h5><p>
                <button type="button" data-toggle="modal" data-target="#searchSubjectModal" class="btn btn-outline-primary btn-sm w-100">
                    Ricerca e Inserimento
                </button>
                <p><h5 class="card-title">Veicoli</h5></p>
                <button type="button" class="btn btn-outline-primary btn-sm w-100"  data-toggle="modal" data-target="#findVehicleModal">
                   Ricerca e Inserimento
                </button>
            </div>
           </div>
          </div>
        </div>
      </div>
      <!--end card-->
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-lg-6" style="left:50%">
      <!--start card-->
      <div class="card-wrapper">
        <div class="card">
          <div class="card-body">
            <div class="categoryicon-top">
              <svg class="icon">
                <use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use>
              </svg>
              <span class="text">Gruppi e Affiliati - Eventi</span>
            </div>
            <a href="{{route('group.listgroup')}}" class="btn btn-outline-primary btn-sm w-100">Gruppi ed Affiliati</a>
            <p class="card-text">Visualizza i Gruppi/Associazioni ed i suoi affiliati</p>
            <button type="button"  class="btn btn-outline-primary btn-sm w-100" data-toggle="modal" data-target="#findEventsModal">
                Eventi e Partecipanti
            </button>
              <p class="card-text">Visualizza gli Eventi e Partecipanti</p>
          </div>
        </div>
      </div>
      <!--end card-->
    </div>
  </div>

    {{-- Modal Subjet --}}
    <div class="modal fade" tabindex="1" role="dialog" id="searchSubjectModal">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ricerca Soggetto</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-close"></use></svg>
                    </button>
                    </div>
                <div class="modal-body">

            {{-- form ricerca soggetti --}}
                    <form action="{{route('subject.indexsubject')}}" method="post">
                        <div class="form-row mt-2">
                         @csrf
                            <div class="form-group col-12">
                                <div class="bootstrap-select-wrapper">
                                        <label>Trova per :</label>
                                         <select title="Scegli una opzione" name="field">
                                                <option value="surname">Cognome</option>
                                                <option value="name">Nome</option>
                                                <option value="cuicode">Codice CUi</option>
                                                <option value="nickname">Soprannome</option>
                                                <option value="placebirth">Luogo di Nascita</option>
                                                <option value="luogo">Luogo</option>
                                                <option value="contacts">Contatto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="form-row mt-2">
                             <div class="form-group col-12">
                                    <input class="form-control" type="text" name="criteria" id="textcriteria" placeholder="Inserire valore da ricercare">
                                    <label for="textcriteria">uguale a :</label>
                                    <small id="helpId" class="form-text text-muted">(usare % come carattere jolly)</small>
                            </div>
                            </div>
                        <div class="form-row mt-2">
                            <div class="form-group col-12">

                                <button type="submit" class="btn btn-outline-primary btn-sm mt-1">
                                    <svg class="icon icon-sm">
                                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-search"></use>
                                    </svg>Ricerca
                                </button>

                                <a class="btn btn-primary btn-sm mt-1"href="{{route('subject.create')}}">
                                    <svg class="icon icon-sm icon-white">
                                    <use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use>
                                    </svg>  Inserimento Nuovo
                                </a>

                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </div>

    {{-- Modal Event --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="findEventsModal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content col-12">
                <div class="modal-header">
                    <h5 class="modal-title">Ricerca Eventi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <svg class="icon">
                            <use xlink:href="{{asset('svg/sprite.svg')}}#it-close"></use>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">


                    {{-- Form Date Events --}}
                    <div class="row mt-5">
                        <div class="col-12">
                            <form action="{{route('event.find')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="date">
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <span>Ricerca per Data Evento</span>
                                    </div>
                                    <div class="form-group col-4">
                                        <input type="date" name="datecriteria" id="datecriteria" style="font-size:small">
                                    </div>
                                    <div class="form-group col-4 text-right">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Cerca</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                    </div>

                    {{-- form between date --}}
                    <div class="row mt-5">
                        <div class="col-12">
                            <form action="{{route('event.find')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="betweendate">
                                <div class="form-row">
                                    <div class="form-group col-3">
                                        <span>Ricerca Periodo</span>
                                    </div>
                                    <div class="form-group col-3">
                                        <p>Data da</p>
                                        <input type="date" name="datefrom" id="datefrom" style="font-size:small">
                                    </div>
                                    <div class="form-group col-3">
                                        <p>Data a</p>
                                        <input type="date" name="dateto" id="dateto" style="font-size:small">
                                    </div>
                                    <div class="form-group col-3 text-right">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Cerca</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                    </div>

                    {{-- form description --}}
                    <div class="row mt-5">
                        <div class="col-12">
                            <form action="{{route('event.find')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="description">
                                <div class="form-row">
                                    <div class="from-group col-4">
                                        <span>Ricerca Descrizione</span>
                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" name="description" id="description">
                                        <small id="helpId" class="form-text text-muted">(usare % come carattere jolly)</small>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Cerca</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Form All Events --}}
                    <div class="row mb-5">
                        <div class="col-12 text-right">
                            <a href="{{route('event.index')}}" class="btn btn-sm btn-outline-primary">Vedi Tutti</a>
                            <a href="{{route('event.create')}}" class="btn btn-sm btn-secondary">Crea Nuovo Evento</a>
                            </div>
                    </div>



                </div>
            </div>
         </div>
    </div>

    {{-- Modal Vehicle --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="findVehicleModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ricerca Veicoli</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <svg class="icon">
                            <use xlink:href="{{asset('svg/sprite.svg')}}#it-close"></use>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('vehicle.index')}}" method="post">
                        @csrf
                        <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="bootstrap-select-wrapper w-100">
                                        <label>Campo da ricercare</label>
                                        <select name="field" title="--- Seleziona un valore ---" class="form-control">
                                            <option value="plate">Targa</option>
                                            <option value="model">Modello</option>
                                            <option value="color">Colore</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group w-100">
                                <input type="text" name="criteria" id="criteria" class="form-control" placeholder="Inserire valore da ricercare">
                                <label for="criteria">testo da ricercare</label>
                                <small id="helpId" class="form-text text-muted">(usare % come carattere jolly)</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  w-100 text-right">
                                <button class="btn btn-outline-primary btn-sm" type="submit">Cerca</button>
                                <a class="btn btn-primary btn-sm" type="button" href="{{route('vehicle.create')}}">Inserisci Nuovo Veicolo</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
