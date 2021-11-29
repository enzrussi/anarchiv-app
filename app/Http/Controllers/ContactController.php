<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
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
        $subject = Subject::find($id);

        return view('contact.createContact',['subject'=>$subject]);
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
            'contact' => 'required',
            'relationship' => 'required',
            'note' => 'max:150'
        ]);

        $subject = Subject::find($request->subject_id);

        $subject->contacts()->create([
            'contact' => $request->contact,
            'contacttype' => $request->contacttype,
            'relationship' => $request->relationship,
            'note' => $request->note,
            'updatedfrom' => Auth::user()->name
        ]);

        return redirect()->route('subject.show',['id'=>$request->subject_id,'tab'=>2]);
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
        $contact = Contact::find($id);

        return view('contact.editContact',['contact' => $contact]);

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
            'contact'=>'required',
            'note'=> 'max:255'
        ]);

        $contact = Contact::find($id);
        $contact->contact = $request->contact;
        $contact->contacttype = $request->contacttype;
        $contact->note = $request->note;
        $contact->updatedfrom = Auth::user()->name;
        $contact->save();

        return redirect()->route('subject.show',$contact->subject_id)->with('tab',2);


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
        $contact = Contact::find($id);
        $contact->delete();

       return redirect()->route('subject.show',['id'=>$contact->subject_id,'tab' => 2]);
    }
}
