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

@can('edit_settings')


<div>
    <form action="{{route('user.updatepassword',$id)}}" method="post">
        @csrf
    <fieldset aria-label="Reset Password">
        <legend>Reset Password</legend>
        <div class="form-group mt-3">
            <input type="text" name="password" id="password" class="form-control" placeholder="Digita una password">
            <label for="password">Nuova Password</label>
        </div>
        <div class="form-group mt-3">
            <input type="text" name="password_confirmation" id="confirm" class="form-control" placeholder="Conferma la nuova password">
            <label for="password_confirmation">Conferma Nuova Password</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Cambia Password</button>
        <a class="btn btn-primary mt-3" href="{{route('user.index')}}">Annulla</a>
    </fieldset>
    </form>

</div>


@endcan
@endsection
