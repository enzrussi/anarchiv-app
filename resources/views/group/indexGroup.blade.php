@extends('base')


@section('content')

    @can('edit_settings')

    @if($errors->any())
        <div class='alert alert-danger'>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif

    <div class='row mt-3'>
        <div class='col-sm'><h3>Gestione Gruppo</h3></div>
        <div class='col-sm'></div>
        <div class="col-sm">
          <button id="myModal" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#testmodal">Crea Nuovo Gruppo</button>
        </div>
        </div>

<table class="table table-striped">
    <thead>
        <th>Nome Gruppo</th>
        <th>Data Creazione</th>
        <th>Data Aggiornamento</th>
        <th></th>
    </thead>
    <tbody>
        @foreach($groups as $group)
        <tr>
        @if(session('edit')==$group->id)
        <form action="{{route('group.update',$group->id)}}" method="post">
            @csrf
            @method('PUT')
        <td>
            <input type="text" name="groupname" id="" value="{{$group->groupname}}">
        </td>
        <td>{{$group->created_at}}</td>
        <td>{{$group->updated_at}}</td>
        <td><button  class="btn btn-primary btn-sm" type="submit">Salva</button></td>
        </form>
        @else
        <td>{{$group->groupname}}</td>
        <td>{{$group->created_at}}</td>
        <td>{{$group->updated_at}}</td>
        <td>
        <div class="float-sm-left pl-1"><a  class="btn btn-primary btn-sm" href="{{route('group.edit',$group->id)}}">Modifica</a></div>
        <div class="float-sm-left pr-1"><form action="{{route('group.destroy',$group)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Sei sicuro di voler eliminare il gruppo?');">Elimina</button>
        </form>
        </div>
        </td>
        </tr>
        @endif
        @endforeach
    </tbody>

</table>

<div class="it-example-modal" id="testmodal1">
    <div class="modal" tabindex="-1" role="dialog" id="testmodal">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form action="{{route('group.store')}}" method="post">
             <div class="modal-header">
                <h5 class="modal-title">Nuovo Gruppo</h5>
             </div>
             <div class="modal-body">
                @csrf
                <fieldset aria-label="Crea Nuovo Gruppo">
                    <div class="form-group">
                        <input type="text" name="groupname" class="form-control">
                        <label for="groupname">Nome Gruppo</label>
                      </div>
                </fieldset>
             </div>
             <div class="modal-footer">
                <button class="btn btn-primary btn-sm" type="submit">Salva</button>
                <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
             </div>
          </div>
        </form>
       </div>
    </div>
 </div>
@endcan




@endsection
