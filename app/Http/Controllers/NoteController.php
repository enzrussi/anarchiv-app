<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('note.createNote',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'description' => 'required',
            'note' => 'required'
        ]);

        $note = new Note();

        $note->description = $request->description;
        $note->note = $request->note;
        $note->subject_id = $request->subject_id;
        $note->updatedfrom = Auth::User()->name;

        $note->save();

        return redirect()->route('subject.show',['id'=>$note->subject_id,'tab'=>5]);
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
        $note = Note::find($id);
        return view('note.editNote',['note' => $note]);
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
            'description' =>'required',
            'note' => 'required'
        ]);

        $note = Note::find($id);
        $note->description = $request->description;
        $note->note = $request->note;
        $note->updatedfrom = Auth::User()->name;

        $note->save();

        return redirect()->route('subject.show',['id'=>$note->subject_id, 'tab'=>5]);
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
        $note = Note::find($id);
        $note->delete();

        return redirect()->route('subject.show',['id'=>$note->subject_id, 'tab'=>5]);
    }
}
