@extends('publicbase')

@section('content')

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('verifyUser')}}"" method="POST">
    @csrf
<div class="form-row align-items-center">
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInput">Perid</label>
      <input type="text" class="form-control" id="inlineFormInput" placeholder="PerID" name="perid">
    </div>
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Password</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Passsword</div>
        </div>
        <input type="password" class="form-control" id="inlineFormInputGroup" placeholder="password" name="password">
      </div>
    </div>
    {{-- <div class="col-auto">
      <div class="form-check m-0">
        <input class="form-check-input" type="checkbox" id="autoSizingCheck">
        <label class="form-check-label" for="autoSizingCheck">
          Ricordami
        </label>
      </div>
    </div> --}}
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Invia</button>
    </div>
  </div>
</form>

@endsection
