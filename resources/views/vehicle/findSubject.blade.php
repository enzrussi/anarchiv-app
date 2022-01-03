@extends('base')
@section('content')
    @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row mt-3">
    <div class="col-12 bg-primary text-white">
        <h5>Selezionare Soggetto da relazionare al veicolo</h5>
    </div>
</div>
<div class="row mt-3">
    <div class="col-4"><h6><span>Targa: </span><span>{{$vehicle->plate}}</span></h6></div>
    <div class="col-4"><span>Modello: </span><span>{{$vehicle->Model}}</span></div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Data di Nascita</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $s)
                <tr>
                    <td><span class="text-uppercase">{{$s->surname}}</span></td>
                    <td><span class="text-capitalize">{{$s->name}}</span></td>
                    <td><span>{{date('d-M-Y',strtotime($s->birthdate))}}</span></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#model{{$s->id}}">
                          Collega
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="model{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="model{{$s->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Collega Nominativo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('vehicle.attachsubject',$vehicle->id)}}" method="POST">
                                        @csrf
                                       <input type="hidden" name="subject_id" value="{{$s->id}}">
                                        <div class="form-row">
                                            <div class="form-group w-100">
                                              <p>Tipo relazione</p>
                                              <select name="relationship" id="relationship">
                                                <option value="Intestatario">Intestatario</option>
                                                <option value="Utilizzatore">Utilizzatore</option>
                                                <option value="Noleggio">Noleggio</option>
                                                <option value="altro">Altro</option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group w-100">
                                              <button type="submit" class="btn btn-primary">Salva</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>
    </div>
</div>



@endsection
