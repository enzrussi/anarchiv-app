@extends('base')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{route('updatepassword')}}" method="POST">
    @csrf
    <input type="hidden" name="perid" value="{{$perid}}">
    <div>
        <fieldset aria-label="Form disabilitato">
        <div class='pt-5 pb-5'>
          <legend>Cambio Password</legend>
        </div>
          <div class="form-group">
            <input type="text" name="oldpassword" class="form-control">
            <label for="disabledTextInput">Vecchia Password </label>
          </div>
          <div class="form-group">
            <input type="text" name="password" class="form-control">
            <label for="disabledTextInput">Nuova Password </label>
          </div>
          <div class="form-group">
            <input type="text" name="password_confirmation" class="form-control">
            <label for="disabledTextInput">Conferma Nuova Password </label>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </fieldset>
      </div>
</form>

@endsection
