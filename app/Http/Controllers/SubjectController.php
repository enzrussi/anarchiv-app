<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Contact;
use App\Models\Group;
use App\Models\Note;
use App\Models\Photo;
use App\Models\Place;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
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
    public function create()
    {
        //
        return view('subject.createSubject');
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
            'name' => "required|max:50",
            'surname' => "required|max:50",
        ]);


        $subject= Subject::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birthdate' => $request->birthdate,
            'placebirth' => $request->placebirth,
            'updatedfrom' => Auth::user()->name
        ]);

        return redirect()->route('subject.show',$subject->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$tab)
    {
        //
        $subject = Subject::find($id);
        $groups = Group::all();

        return view('subject.showSubject',['subject' => $subject, 'groups' => $groups, 'tab' => $tab]);
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
        $subject = Subject::find($id);
        return view('subject.editSubject',['subject'=>$subject]);
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
            'name' => 'required',
            'surname' => 'required',
        ], $messages=[
            'name.required' => 'Inserire un Nome',
            'surname.required' => 'Inserire un Cognome'
        ]);

        $subject = Subject::find($id);

        $subject->name = $request->name;
        $subject->surname = $request->surname;
        $subject->nickname = $request->nickname;
        $subject->birthdate = $request->birthdate;
        $subject->placebirth = $request->placebirth;
        $subject->cuicode = $request->cuicode;
        $subject->fiscalcode = $request->fiscalcode;
        $subject->updatedfrom = Auth::User()->name;

        $subject->save();

        return redirect()->route('subject.show',['id'=>$subject->id,'tab'=>1])->with('alerttype','success')->with('alertmessage','Soggetto modificato con successo');


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
    }

    public function indexSubject(Request $request){

        $subject = Subject::where($request->field,'like', $request->criteria)->get();
        return view('subject.indexSubject',['subject' => $subject]);

    }

    public function attachGroup($id,$group_id){

        $subject = Subject::find($id);
        $subject->groups()->attach($group_id);
        return redirect()->route('subject.show',['id'=>$subject->id,'tab'=>1]);

    }

    public function detachGroup($id,$group_id){
        $subject = Subject::find($id);
        $subject->groups()->detach($group_id);
        return redirect()->route('subject.show',['id'=>$subject->id,'tab'=>1]);
    }

}
