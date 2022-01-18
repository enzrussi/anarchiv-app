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

    <div class="bg-primary text-white mb-3 mt-5 p-2">
        <h5>Modifica Veicolo</h5>
    </div>

    {{-- FORM --}}
    <div class="row mt-5">
        <div class="col-8">
            <form action="{{route('vehicle.update',$vehicle->id)}}" method="POST">
                @csrf
                @method('PUT')
            <div class="form-row">
            <div class="form-group col-3">
                <input type="text" class="form-control" name="plate" id="plate" value="{{$vehicle->plate}}">
                <label for="plate">Targa</label>
            </div>
            <div class="form-group col-3">
                <input type="text" class="form-control" name="model" id="model"value="{{$vehicle->model}}">
                <label for="Model">Modello</label>
            </div>
            <div class="form-group col-3">
                <input type="text" class="form-control" name="color" id="color" value="{{$vehicle->color}}">
                <label for="color">Colore</label>
            </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <textarea name="note" id="note" cols="30" rows="10">{{$vehicle->note}}</textarea>
                    <label for="note">Note</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-primary btn-sm">Salva</button>
                    <a href="{{url()->previous()}}" class="btn btn-outline-primary btn-sm">Annulla</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId">
                        <svg class="icon icon-white icon-sm"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
                        Elimina il Veicolo
                    </button>
                </div>
            </div>
            </form>
        </div>
        {{-- Photo Update --}}
       <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <p class="font-weight-bold">FOTO VEICOLO</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($vehicle->photovehicle == Null)
                    <img src="{{asset('svg/CAR.svg')}}" style="width:400px">
                    @else
                    <img src="{{asset('photovehicle')}}/{{$vehicle->photovehicle}}" style="width:400px">
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <form method="POST" action="{{route('vehicle.updatephoto',$vehicle->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <input type="file" name="url" id="url[]" multiple="multiple">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <button type="submit" class="btn btn-sm btn-primary">Carica la Foto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
       </div>
    </div>

     <!-- Modal Delete -->
     <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confermi l'Eliminazione del Veicolo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>Confermi l'eliminazione del veicolo e di tutte le sue relazioni con i vari soggetti? </p>
                    <p>La procedura è irreversibile</p>
                </div>
                <div class="modal-footer">
                    <form action="{{route('vehicle.destroy',$vehicle->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <svg class="icon icon-white"><use xlink:href="{{asset('svg/sprite.svg')}}#it-delete"></use></svg>
                            Elimina il veicolo
                        </button>
                    </form>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-dismiss="modal" aria-label="Close">
                        Annulla
                    </button>
                </div>
            </div>
        </div>



@endsection

