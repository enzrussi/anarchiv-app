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
            <div class="mb-2">
            <p><h5 class="card-title">Database di soggetti attenzionati dall'attività</h5><p>
            </div>
            <div class="form-row mt-2">
                <form action="{{route('subject.indexsubject')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="bootstrap-select-wrapper">
                            <label>Trova per :</label>
                        <select title="Scegli una opzione" name="field">
                            <option value="surname">Cognome</option>
                            <option value="name">Nome</option>
                            <option value="cuicode">Codice CUi</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <input class="form-control" type="text" name="criteria" id="textcriteria" placeholder="Inserire criterio da ricercare">
                    <label for="textcriteria">uguale a :</label>
                            <button type="submit" class="btn btn-primary btn-sm mt-1">Ricerca</button>
                            <a class="btn btn-primary btn-sm mt-1"href="{{route('subject.create')}}">Inserimento Nuovo</a>
                    </form>
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
              <span class="text">Gruppi e Associazioni</span>
            </div>
            <a href="#">
              <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor…</h5>
            </a>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>
      <!--end card-->
    </div>
  </div>


@endsection
