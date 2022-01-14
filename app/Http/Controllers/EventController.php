<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Subject;
use App\Models\Document;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Event::all();

        return view('event.indexEvent',['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('event.createEvent');
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
            'dateevent'=>'required',
            'description'=>'required|max:150'
        ],$messages=[
            'datevent.required'=>'Inserire la data dell\'evento',
            'descritpio.required'=>'Inserire una descrizione'

        ]);

        $event = new Event();
        $event->description = $request->description;
        $event->dateevent = $request->dateevent;
        $event->note = $request->note;
        $event->updatedfrom = Auth::User()->name;
        $event->save();

        return redirect()->route('event.index')->with('alerttype','success')->with('alertmessage',"Evento inserito con successo");
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
        $event = Event::find($id);
        $subjects = Subject::all();

        return view('event.showEvent',['event'=>$event,'subjects'=>$subjects]);
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
            'description' => 'required',
            'dateevent'=> 'required'
        ]);


        $event = Event::find($id);

        $event->description = $request->description;
        $event->dateevent = $request->dateevent;
        $event->note = $request->note;
        $event->updatedfrom = Auth::User()->name;

        $event->save();

        return redirect()->route('event.show' ,$id)->with('alerttype','success')->with('alertmessage','Evento Aggiornato con successo');

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
        $event = Event::find($id);
        DB::table('event_subject')->where('event_id',$id)->delete();
        DB::table('documents')->where('event_id')->delete();
        $event->delete();

        return redirect()->route('event.index')->with('alerttype','warning')->with('alertmessage','Evento cancellato con successo');

    }

    public function editEventSubject($id){


        $event = Event::find($id);
        $subjects = Subject::all()->sortBy(['surname','name']);

        // return view('event.editEventSubject',['event'=>$event, 'subjects'=>$subjects]);

        return view('event.ajaxeditEventSubject',['event'=>$event,'subjects'=>$subjects]);

    }

    public function attachEventSubject($id,$subject_id){
        $event = Event::find($id);
        $event->subjects()->attach($subject_id);

        return response()->json($event->subjects);

    }

    public function detachEventSubject($id,$subject_id){
        $event = Event::find($id);
        $event->subjects()->detach($subject_id);

        return response()->json($event->subjects);
    }

    public function find(Request $request){

        switch ($request->type){

            case 'date':
                $events = Event::whereDate('dateevent',"=",$request->datecriteria)->get();
                break;

            case 'betweendate':
                $events = Event::whereBetween('dateevent',[$request->datefrom,$request->dateto])->get();
                break;

            case 'description':
                $events = Event::where('description','like','%'.$request->description.'%')->get();
                break;

        }



        return view('event.indexEvent',['events'=>$events])
        ->with('alerttype','success')
        ->with('alertmessage','Eventi trovati ...');


    }


}
