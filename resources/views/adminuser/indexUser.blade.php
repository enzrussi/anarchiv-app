@extends('base')

@section('content')

<div class='row mt-3'>
<div class='col-sm'><h3>Gestione Utenti</h3></div>
<div class='col-sm'></div>
<div class="col-sm">
  <a class="btn btn-primary" href="{{route('user.create')}}">Crea Nuovo Utente</a>
</div>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Perid</th>
        <th scope="col">Nome Utente</th>
        <th scope="col">Administrator</th>
        <th scope="col">Creato il</th>
        <th scope="col">Aggiornato il</th>
        <th scope="col">Funzioni</th>
      </tr>
    </thead>
    <tbody>

      @foreach($users as $user)
      <tr>
        <th scope="row">{{$user->perid}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->admin}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>
        <td><a href="{{route('user.edit',$user->id)}}">modifica</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>



@endsection
