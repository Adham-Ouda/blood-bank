<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governorate;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = Governorate::paginate(20);
        return view('governorates.index',compact('records')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       $rules = [
         'governorate' => 'required'
       ];

       $messages = [
        'governorate.required' => 'Governorate is required'
       ];

        $this->validate($request,$rules,$messages);

        $record = new Governorate;
        $record->governorate = $request->input('governorate');
        $record->save();
        
        //flash('Message')->success(): Set the flash theme to "success".
        //flash('Message')->important(): Add a close button to the flash message.
        
        flash()->success('Success')->important();

        //$record = Governorate::create($request->all());

         return redirect(route('governorate.index'));   
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
        $model = Governorate::findOrFail($id);
        return view ('governorates.edit',compact('model'));
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
        $record = Governorate::findOrFail($id);
        $record->update($request->all());
        flash()->success('Edited')->important();
        return redirect(route('governorate.index'));

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
        $record = Governorate::findOrFail($id);
        $record->delete();
        //from laravelcollective docimentation flash('Message')->error(): Set the flash theme to "danger".
        flash()->error('Deleted')->important();
        return back();
    }
}
