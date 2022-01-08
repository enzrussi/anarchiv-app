<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
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
        return view('place.createPlace',['id'=>$id]);
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
            'name' => 'required|max:100',
            'address' => 'max:150',
            'city' => 'max:50',
            'zipcode'=>'max:15',
            'relationship' => 'max:150'
        ]);

        $place = new Place();

        $place->fill([
            'name'=>$request->name,
            'address'=>$request->address,
            'city' => $request->city,
            'zipconde' => $request->zipcode,
            'relationship' => $request->relationship,
            'subject_id'=>$request->subject_id,
            'updatedfrom'=> Auth::user()->name,
            'note' => $request->note,

        ]);

        $place->save();

        return redirect()->route('subject.show',['id'=>$request->subject_id,'tab'=>4]);



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
        $place = Place::find($id);

        return view('place.editPlace',['place'=>$place]);
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
        $place = Place::find($id);

        $validate = $request->validate([
            'name' => 'required|max:100',
            'address' => 'max:150',
            'city' => 'max:50',
            'zipcode'=>'max:15',
            'relationship' => 'max:150'
        ]);

        $place->name = $request->name;
        $place->address = $request->address;
        $place->city = $request->city;
        $place->zipcode = $request->zipcode;
        $place->relationship = $request->relationship;
        $place->note = $request->note;
        $place->updatedfrom = Auth::user()->name;
        $place->save();

        return redirect()->route('subject.show',['id'=>$place->subject_id,'tab'=>4]);

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

        $place = Place::find($id);
        $place->delete();

        return redirect()->route('subject.show',['id'=>$place->subject_id,'tab'=>4]);

    }
}
