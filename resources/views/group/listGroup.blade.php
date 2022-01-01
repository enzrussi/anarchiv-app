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

<div class="row mt-5 mb-3 ">
    <h5>Gruppi</h5>
</div>

<div id="collapseDiv1" class="collapse-div" role="tablist">
    @foreach ($groups as $group )
    <div class="collapse-header" id="heading{{$group->id}}">
        <button data-toggle="collapse" data-target="#collapse{{$group->id}}" aria-expanded="true" aria-controls="collapse{{$group->id}}">
            {{$group->groupname}} <span class="badge badge-light">{{$group->subjects->count()}}</span>
        </button>
      </div>
      <div id="collapse{{$group->id}}" class="collapse" role="tabpane{{$group->id}}" aria-labelledby="heading{{$group->id}}">
        <div class="collapse-body">
                @foreach ($group->subjects->sortBy('surname')->sortBy('name') as $subject )
                <div class="chip chip-lg">
                    <div class="avatar size-lg">
                      <img src="{{asset('photo')}}/{{$subject->photo}}" alt="{{$subject->surname}} {{$subject->name}}">
                    </div>
                    <label class="chip-label text-uppercase" for="chip-03">
                        <a href="{{route('subject.show',['id'=>$subject->id,'tab'=>1])}}">
                            {{$subject->surname}} {{$subject->name}} {{date('d-m-Y',strtotime($subject->birthdate))}}</a>
                    </label>
                  </div>
                @endforeach

        </div>
      </div>
    @endforeach
</div>


@endsection
