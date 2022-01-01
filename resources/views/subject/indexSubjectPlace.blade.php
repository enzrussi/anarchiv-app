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
                    <th>Comune</th>
                    <th>Indirizzo</th>
                    <th>Relazione</th>
                    <th>Nominativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $p )
                <tr>
                    <td class="text-capitalize">{{$p->city}}</td>
                    <td>{{$p->address}}</td>
                    <td>{{$p->relationship}}</td>
                    <td>
                        <a href="{{route('subject.show',['id'=>$p->subject_id,'tab'=>4])}}">
                            <span class="text-uppercase">{{$p->subject->surname}}</span><span class="text-capitalize"> {{$p->subject->name}}</span><span> {{date('d/m/Y',strtotime($p->subject->birthdate))}}</span>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
