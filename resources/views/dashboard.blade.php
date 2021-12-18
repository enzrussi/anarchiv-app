@extends('base')


@section('content')

<div class="row">
    <div class="col-12 col-lg-6">
      <!--start card-->
      <div class="card-wrapper">
        <div class="card">
          <div class="card-body">
            <div class="categoryicon-top">
              <svg class="icon">
                <use xlink:href="{{asset('svg/sprite.svg')}}#it-user"></use>
              </svg>
              <span class="text">Soggetti</span>
            </div>
            <div class="mb-5">
            <p><h5 class="card-title">Database di soggetti attenzionati dall'attività</h5><p>
            </div>

                <form action="{{route('subject.indexsubject')}}" method="post">
                    <div class="form-row mt-2">
                    @csrf
                    <div class="form-group">
                        <div class="bootstrap-select-wrapper">
                            <label>Trova per :</label>
                        <select title="Scegli una opzione" name="field">
                            <option value="surname">Cognome</option>
                            <option value="name">Nome</option>
                            <option value="cuicode">Codice CUi</option>
                            <option value="nickname">Soprannome</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <input class="form-control" type="text" name="criteria" id="textcriteria" placeholder="Inserire criterio da ricercare">
                    <label for="textcriteria">uguale a :</label>
                            <button type="submit" class="btn btn-outline-primary btn-sm mt-1">
                                <svg class="icon icon-sm">
                                <use xlink:href="{{asset('svg/sprite.svg')}}#it-search"></use>
                                </svg>Ricerca</button>
                            <a class="btn btn-primary btn-sm mt-1"href="{{route('subject.create')}}">
                                <svg class="icon icon-sm icon-white">
                                <use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use>
                                </svg>  Inserimento Nuovo</a>
                        </div>
                        </form>

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
            <a href="{{route('group.listgroup')}}">
              <h5 class="card-title">Gruppi ed Affiliati</h5>
            </a>
            <p class="card-text">Visualizza i Gruppi/Associazioni ed i suoi affiliati</p>
            <a href="#">
                <h5 class="card-title">Eventi e Partecipanti</h5>
              </a>
              <p class="card-text">Visualizza gli Eventi e Partecipanti</p>
          </div>
        </div>
      </div>
      <!--end card-->
    </div>
  </div>


@endsection
