@extends('base')


@section('content')
{{Auth::user()}}

<a href="{{route('logout')}}">Logout</a>
<br>
dashboard
@endsection
