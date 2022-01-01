<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    //
public function store(Request $request){

    $validate = $request->validate([
        'description' => 'required|max:150',
        'datedocument' => 'date|required',
        'note'=>'max:255'
    ]);

    $doc = new Document();

    $doc->description = $request->description;
    $doc->datedocument =$request->datedocument;
    $doc->note = $request->note;
    $doc->updatedfrom = Auth::user()->name;
    $doc->event_id = $request->event_id;
    $doc->save();

    return redirect()->route('event.show',$request->event_id)->with('alerttype','success')->with('alertmessage','Documentazione Inserita con successo!');

}

public function update(Request $request,$id){

    $validate = $request->validate([
        'description' => 'required|max:150',
        'datedocument' => 'required',
        'note'=>'max:255'
    ]);

    $doc = Document::find($id);

    $doc->description = $request->description;
    $doc->datedocument = $request->datedocument;
    $doc->note = $request->note;
    $doc->updatedfrom = Auth::user()->name;
    $doc->save();

    return redirect()->route('event.show',$doc->event_id)->with('alerttype','success')->with('alertmessage','Dato Modificato con successo!');
}

public function destroy($id){

    $doc = Document::find($id);
    $doc->delete();

    return redirect()->route('event.show',$doc->event_id)->with('alerttype','warning')->with('alertmessage','Documentazione Eliminata');
}

}
