@extends('base')
@section('content')
    @if ($errors->any())
        <div class='alert alert-danger'>
            <ul>
                @foreach ($errores->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row mt-5">
    <div class="col-8">
    <h5>Eventi</h5>
    </div>
    <div class="col-4 text-right">
        <a class="btn btn-primary btn-sm" href="{{route('event.create')}}">
            <svg class="icon icon-sm icon-white"><use xlink:href="{{asset('svg/sprite.svg')}}#it-plus-circle"></use></svg>
        Nuovo Evento
        </a>
    </div>
</div>
<div class="row mt-5">
    <table class="table">
        <thead><tr>
            <th>Data Evento</th>
            <th>Descrizione</th>
            <th></th>
        </tr></thead>
        <tbody>
    @foreach ($events as $event )
            <tr>
                <td>{{$event->dateevent}}</td>
                <td>{{$event->description}}</td>
                <td><a href="{{route('event.show',$event->id)}}">
                    <svg class="icon"><use xlink:href="{{asset('svg/sprite.svg')}}#it-external-link"></use></svg>
                    </a>
                </td>
            </tr>

    @endforeach
        </tbody>
    </table>
</div>
@endsection
