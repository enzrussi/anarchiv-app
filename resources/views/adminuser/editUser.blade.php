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

{{-- form edit user --}}
@can('edit_settings')


<form action="{{route('user.update',$user->id)}}" method="POST">
@csrf
@method('PUT')
<input type="hidden" name="id" value="{{$user->id}}">
<fieldset aria-label="Modifica Utente">
    <div class='pt-5 pb-5'>
        <legend>Modifica Utente</legend>
      </div>
        <div class="form-group">
          <input type="text" name="perid" value="{{$user->perid}}" disabled class="form-control">
          <label for="perid">PerId</label>
        </div>
        <div class="form-group">
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
            <label for="name">Cognone e Nome</label>
        </div>
        <div class="form-group">
            @if($user->admin == true )
            <input type="checkbox" name="admin" id="admin" checked>
            @else
            <input type="checkbox" name="admin" id="admin">
            @endif
            <label for="admin">Administrator</label>
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary mt-3">Aggiorna</button>
        <a class="btn btn-primary mt-3" href="{{route('user.index')}}" >Annulla</a>
        <a class="btn btn-primary mt-3" href="{{route('user.resetpassword',$user->id)}}">Reset Password</a>

</form>
<form action="{{route('user.destroy',$user->id)}}" method="post">
    @csrf
    @method('DELETE')
<button type="submit" name="delButton" class="btn btn-primary mt-3"
    onclick="return confirm('Sei sicuro di voler eminare l\'utente?')">Elimina Utente</button>
</form>

@endcan

@endsection
