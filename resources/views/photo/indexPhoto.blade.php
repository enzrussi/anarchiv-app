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


    <div class="row mb-3 mt-3">
        <div class="col-8 border-bottom">
            <a href="{{route('subject.show',['id'=>$subject->id,'tab'=>1])}}">
            <div class="avatar size-xl"><img src="{{asset('photo').'/'.$subject->photo}}" alt="??"></div>
            <span class="text-uppercase font-weight-bold">{{ $subject->surname }} </span>
            <span class="text-capitalize font-weight-bold">{{ $subject->name }} </span>
            <span> nato a </span><span class="text-capitalize">{{ $subject->placebirth }} </span>
            <span> in data </span><span>{{date('d-m-Y',strtotime($subject->birthdate)) }}</span>
            </a>
        </div>
        <div class="col-4 text-right"><a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#formUploadPhotoModal">Inserisci Nuova</a>
        </div>
    </div>

    <div class="row col-12">
        Cliccare sulla foto per altre funzioni
    </div>

    <div class="it-grid-list-wrapper">
        <div class="grid-row">
            @foreach ($subject->photos as $photo )

            <div class="col-6 col-lg-4">
                <div class="it-grid-item-wrapper it-grid-item-overlay">
                    <a href="{{route('photo.show',$photo->id)}}">
                    <div class="img-responsive-wrapper">
                      <div class="img-responsive">
                        <div class="img-wrapper"><img src="{{ asset('photo\\'.$photo->url)}} " alt="image Alt" title="Note:{{$photo->note}}"></div>
                      </div>
                    </div>
                    <span class="it-griditem-text-wrapper ">

                        <span class="it-griditem-text">
                            <p>{{$photo->description}} - {{$photo->url}}</p>

                        </span>

                    </span>
                </a>
                </div>
              </div>

            @endforeach


        </div>


      </div>

      <div class="it-example-modal">
        <div class="modal" tabindex="-1" role="dialog" id="formUploadPhotoModal">
           <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title">Upload Nuova Foto</h5>
                 </div>
                 <div class="modal-body">
                    <form method="POST" action="{{route('photo.store',['id'=>$subject->id])}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
                    <div class="form-row col-12">
                        <div class="form-group col-12 ">
                            <input type="text" name="description" class="form-control" id="description" placeholder="descrizione">
                            <label for="description">Descrizione</label>
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="form-group col-12">
                            <input type="file" name="url" id="url[]" multiple="multiple" >
                            {{-- <label for="url">File Upload</label> --}}
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="form-group col-12 ">
                            <input type="text" name="note" class="form-control" id="note" placeholder="note">
                            <label for="note">Note</label>
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="form-group col-12">
                        <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                        <button class="btn btn-primary btn-sm" type="submit">Upload</button>
                        </div>
                    </div>

                    </form>
                 </div>
                 <div class="modal-footer">


                 </div>
              </div>
           </div>
        </div>
     </div>





@endsection
