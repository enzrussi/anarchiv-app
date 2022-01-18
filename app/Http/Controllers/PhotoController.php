<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Subject;
use DateTime;
use Illuminate\Support\Facades\Auth;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index($id)
    {
        //
        $subject = Subject::find($id);

        return view('photo.indexPhoto',['subject'=>$subject]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $validate = $request->validate([
            'url'=>'required|file|mimes:jpg'
        ],$messages=[
            'url.required' => 'E\' richiesto almeno un file',
            'mimes' => 'Il file immagine deve essere .jpg'
        ]);

        $photodir = "./photo/";

        $date = new DateTime();

        $photofilename = $request->subject_id.'s'.strval($date->getTimestamp()).".jpg";

        move_uploaded_file($_FILES['url']['tmp_name'],$photodir.$photofilename);

        $photo = new Photo();
        $photo->url = $photofilename;
        $photo->description = $request->description;
        $photo->note = $request->note;
        $photo->updatedfrom = Auth::User()->name;
        $photo->subject_id=$request->subject_id;

        $photo->save();

        return redirect()->route('photo.index',['id'=>$photo->subject_id]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $photo = Photo::find($id);

        return view('photo.showPhoto',['photo'=>$photo]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate = $request->validate([
            'description'=>'required'
        ],$messages = [
            'description.required'=> 'Inserire una Descrizione.'

        ]);

        $photo = Photo::find($id);
        $photo->description = $request->description;
        $photo->note = $request->note;
        $photo->updatedfrom = Auth::User()->name;

        $photo->save();

        return redirect()->route('photo.show',$photo->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $photo = Photo::find($id);

        $photodir = $_SERVER['DOCUMENT_ROOT'].'\\photo\\';

        $photo->delete();
        unlink($photodir.$photo->url);

        $subject = Subject::where('subject_id',$photo->subject_id)->get();

        return redirect()->route('photo.index',$photo->subject_id);



    }

    /**
     * insert the profile photo in subject
     */

     public function updatephotosubject($id){

        $photo = Photo::find($id);

        $photo->subject->photo = $photo->url;
        $photo->subject->save();

        return redirect()->route('photo.show',$photo->id);


     }
}
