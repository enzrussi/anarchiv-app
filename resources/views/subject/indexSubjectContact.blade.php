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

<div class="row">
    <div class="col-12 bg-primary text-white mt-3 p-2">
        <h6>Esito Ricerche</h6>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Contatto</th>
                    <th>Tipo</th>
                    <th>Relazione</th>
                    <th>Nominativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $c )
                <tr>
                    <td>{{$c->contact}}</td>
                    <td class="text-uppercase">{{$c->contacttype}}</td>c
                    <td class="text-uppercase">{{$c->relationship}}</td>
                    <td>
                        <a href="{{route('subject.show',['id'=>$c->subject_id,'tab'=>4])}}">
                            <span class="text-uppercase">{{$c->subject->surname}}</span><span class="text-capitalize"> {{$c->subject->name}}</span><span> {{date('d/m/Y',strtotime($c->subject->birthdate))}}</span>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
