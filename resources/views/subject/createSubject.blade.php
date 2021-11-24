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

<div class="affix-example container mt-5">
  <div class="row">
    <div class="col-6 col-md-3 p-2 affix-parent">
      <div class="primary-bg p-3 mb-1">
        <p class="mb-0 white-color"> Inserimento Nuovo Soggetto</p>
      </div>
    </div>
    <div class="col-6 col-md-9 p-2">
        <form action="{{route('subject.store')}}" method="post">
            @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="name" id="formNome">
              <label for="formNome">Nome</label>
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="surname" id="formCognome">
              <label for="formCognome">Cognome</label>
            </div>
          </div>
          <div class="it-datepicker-wrapper">
          <div class="form-row">
            <div class="form-group col-md-12">
            <input type="date" class="form-control it-date-datepicker" name="birthdate" id="birthdate" placeholder="inserisci la data in formato gg/mm/aaaa">
            <label for="birthdate">Data di nascita</label>
            </div>
          </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
            <input type="text" class="form-control" name="placebirth" id="placebirth">
            <label for="placaebirth">Luogo di Nascita</label>
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                <a class="btn btn-primary btn-sm" href="{{route('dashboard')}}">Annulla</a>
              </div>
          </div>
        </form>
    </div>
  </div>
  <div class="row p-2 d-none d-md-block">
    <p>Una volta inseriti i dati salienti si verrà trasferiti nella maschera di inserimento completa.</p>
  </div>
</div>
@endsection

<script type="text/javascript">
$(document).ready(function() {
    $('.it-date-datepicker').datepicker({
      inputFormat: ["dd/MM/yyyy"],
      outputFormat: 'dd/MM/yyyy',
    });
});

</script>
