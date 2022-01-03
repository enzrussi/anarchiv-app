<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $validate=$request->validate([
            'field'=>'required'
        ]);

        $vehicles = Vehicle::where($request->field,'like',$request->criteria)->get();

        return view('vehicle.indexVehicle',['vehicles'=>$vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('vehicle.createVehicle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

        $validate = $request->validate([
            'plate'=>'required|unique:vehicles|max:50',
            'model'=>'max:150',
            'color'=>'max:100',
        ],$messages=[
            'plate.unique'=>'Targa già presente nel database.Effettuare una Ricerca'
        ]);


        $vehicle = new Vehicle();
        $vehicle->plate = $request->plate;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->updatedfrom = Auth::user()->name;
        $vehicle->note = $request->note;
        $vehicle->save();

        return redirect()->route('vehicle.show',$vehicle->id);



    }
    public function storeAndAttachSubject(Request $request, $id)
    {
        //
        $validate = $request->validate([
            'plate'=>'required|max:50',
            'model'=>'max:150',
            'color'=>'max:100',
            'relationship'=>'required',
        ]);

        $vehicle = new Vehicle();
        $vehicle->plate = $request->plate;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->updatedfrom = Auth::user()->name;
        $vehicle->note = $request->note;
        $vehicle->save();
        $vehicle->subjects()->attach($id,[
            'relationship'=>$request->relationship,
            'updatedfrom'=>Auth::user()->name,
        ]);
        $vehicle->relationship = $request->relationship;
        $vehicle->updatedfrom = Auth::user()->name;
        $vehicle->note = $request->note;
        return redirect()->route('subject.show',['id'=>$id,'tab'=>3]);
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
        $vehicle = Vehicle::find($id);
        return view('vehicle.showVehicle',['vehicle'=>$vehicle]);
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
        $vehicle = Vehicle::find($id);

        return view('vehicle.updateVehicle',['vehicle'=>$vehicle]);

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
            'plate'=>'required|max:50',
            'model'=>'max:150',
            'color'=>'max:100',
            'relationship'=>'required|max:100',
            'note' => 'max:255'
        ]);

        $vehicle = Vehicle::find($id);

        $vehicle->plate = $request->plate;
        $vehicle->model = $request->model;
        $vehicle->color = $request->color;
        $vehicle->relationship = $request->relationship;
        $vehicle->updatedfrom = Auth::user()->name;
        $vehicle->note = $request->note;

        $vehicle->save();

        return redirect()->route('subject.show',['id'=>$vehicle->subject_id,'tab'=>3]);
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
        $vehicle = Vehicle::find($id);
        $vehicle->delete();

        return redirect()->route('subject.show',['id'=>$vehicle->subject_id,'tab'=>3]);

    }

    public function findSubject(Request $request,$id){

        $validate = $request->validate([
            'surname' => 'required'
        ]);

        $subjects = Subject::where('surname','like',$request->surname)->get();
        $vehicle = Vehicle::find($id);

        return view('vehicle.findsubject',['subjects'=>$subjects,'vehicle'=>$vehicle]);

    }

    public function attachSubject(Request $request,$id){

        $vehicle = Vehicle::find($id);

        $vehicle->subjects()->attach($request->subject_id,[
            'updatedfrom'=>Auth::user()->name,
            'relationship'=>$request->relationship,
        ]);

        return redirect()->route('vehicle.show',$id);

    }


}
