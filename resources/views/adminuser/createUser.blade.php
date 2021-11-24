@extends('base')

@section('content')

{{-- view error --}}
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ( $errors->all() as $error )

        <li>{{$error}}</li>

        @endforeach

    </ul>
</div>
@endif

{{-- form create user --}}
@can('edit_settings')
<form action="{{route('user.store')}}" method="POST">
    @csrf
    <fieldset aria-label="Crea Nuovo Utente">
        <div class='pt-5 pb-5'>
            <legend>Crea Nuovo Utente</legend>
          </div>
            <div class="form-group">
              <input type="text" name="perid" class="form-control">
              <label for="perid">PerId</label>
            </div>
            <div class="form-group">
                <input type="text" name="name" class="form-control">
                <label for="name">Cognome e Nome</label>
            </div>
            <div class="form-group">
                <input type="checkbox" name="admin" id="admin">
                <label for="admin">Administrator</label>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="password" id="password">
                <label for="password">Password</label>
            </div>
            <div class="form-group">
                <input type="text" class="form_control" name="password_confirmation" id="password_confirmed">
                <label for="password_confirmation">Conferma Password</label>

            </div>
        </fieldset>
            <button type="submit" class="btn btn-primary mt-3">Crea Nuovo Utente</button>
            <a class="btn btn-primary mt-3" href="{{route('user.index')}}">Annulla</a>
    </form>

@endcan


@endsection
