<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Subject;
use Nette\Utils\Random;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::all()->sortBy('groupname');
        return view('group.indexGroup',['groups' => $groups]);
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
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        //
        $validate = $request->validate([
            'groupname'=>'required|max:20|unique:groups',
        ],$messages=[
            'groupname.required'=>'Nome gruppo richiesto',
            'groupname.unique' => 'Nome gruppo già esistente',
            'groupname.max' => 'Nome gruppo troppo lungo (max 20 caratteri)'
        ]);

        $group = new Group();
        $group->groupname = $request->groupname;
        $group->save();

        return redirect()->route('group.index')->with('alerttype','success')->with('alertmessage','Gruppo creato con successo');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
        $subjects = Subject::all();

        return view('group.updateGroupSubject',['group'=>$group,'subjects'=>$subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return redirect()->route('group.index')->with('edit',$group->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
        $validate = $request->validate([
            'groupname'=>'required|max:20|unique:groups',
        ],$messages=[
            'groupname.required'=>'Nome gruppo richiesto',
            'groupname.unique' => 'Nome gruppo già esistente',
            'groupname.max' => 'Nome gruppo troppo lungo (max 20 caratteri)'
        ]);

        $group->groupname = $request->groupname;
        $group->save();
        return redirect()->route('group.index')->with('alerttype','success')->with('alertmessage','Gruppo modificato con successo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
        $group->delete();

        DB::table('group_subject')->where('group_id',$group->id)->delete();



        return redirect()->route('group.index')->with('alerttype','warning')->with('alertmessage','Gruppo eliminato con successo');

    }

    public function listGroup(){

        $groups = Group::all()->sortBy('groupname');

        return view('group.listGroup',['groups'=>$groups]);

    }

    public function attachSubject($id,$subject_id){

        $group = Group::find($id);
        $group->subjects()->attach($subject_id);

        return response()->json($group->subjects());
    }

    public function detachSubject($id,$subject_id){

        $group = Group::find($id);
        $group->subjects()->detach($subject_id);

        return response()->json($group->subjects());

    }



}
