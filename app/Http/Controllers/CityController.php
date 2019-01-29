<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;
use App\Governorate;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$records = City::paginate(20);
        //$governorates = Governorate::paginate(20);
        //DB::table('governorates')->get();//->where('id', $request->governorate_id);//->pluck('governorate');
        $records = DB::table('cities')
        ->join('governorates', function ($join) {
            $join->on('cities.governorate_id', '=', 'governorates.id');
        })
        ->get();
        return view('cities.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /*$records = DB::table('cities')
        ->join('governorates', function ($join) {
            $join->on('cities.governorate_id', '=', 'governorates.id');
        })
        ->get();*/
        $records = DB::table('cities')
            ->crossJoin('governorates')
            ->get();
        return view('cities.create',compact('records'));   

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
         'city' => 'required'
       ];

       $messages = [
        'city.required' => 'City is required'
       ];

        $this->validate($request,$rules,$messages);

        // $record = new City;
        // $record->city = $request->input('city');
        // $record->governorate_id = $request->input('governorate_id');
        // $record->save();

        $city = City::create($request->all());
        
        flash()->success('Success')->important();


         return redirect(route('city.index')); 
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
        $model = City::findOrFail($id);
        return view ('cities.edit',compact('model'));
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
        $record = City::findOrFail($id);
        $record->update($request->all());
        flash()->success('Edited')->important();
        return redirect(route('city.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = City::findOrFail($id);
        $record->delete();
        flash()->error('Deleted')->important();
        return back();
    }
}
