<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Settings::paginate(20);
        return view('settings.index',compact('records')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.create');
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
         'second_slide' => 'required' ,
         'about_app' => 'required' ,
         'address' => 'required' ,
         'mobile_number' => 'required' ,
         'phone' => 'required' ,
         'website' => 'required' ,
         'social_media_channels' => 'required' ,
         'latitude' => 'required' ,
         'longitude' => 'required' ,
         'email' => 'required' 
       ];

       $messages = [
        'second_slide.required' => 'Second Slide Content is required' ,
        'about_app.required' => 'about app is required' ,
        'address.required' => 'address is required' ,
        'mobile_number.required' => 'mobile number is required' ,
        'phone.required' => 'phone is required' ,
        'website.required' => 'website is required' ,
        'social_media_channels.required' => 'social media channels is required' ,
        'latitude.required' => 'latitude is required' ,
        'longitude.required' => 'longitude is required' ,
        'email.required' => 'email is required' 
       ];

        $this->validate($request,$rules,$messages);

        $record = new Settings;
        $record->second_slide = $request->input('second_slide');
        $record->about_app = $request->input('about_app');
        $record->address = $request->input('address');
        $record->mobile_number = $request->input('mobile_number');
        $record->phone = $request->input('phone');
        $record->website = $request->input('website');
        $record->social_media_channels = $request->input('social_media_channels');
        $record->latitude = $request->input('latitude');
        $record->longitude = $request->input('longitude');
        $record->email = $request->input('email');
        $record->save();
        
        //flash('Message')->success(): Set the flash theme to "success".
        //flash('Message')->important(): Add a close button to the flash message.
        
        flash()->success('Success')->important();

        //$record = Settings::create($request->all());

         return redirect(route('settings.index'));   
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
        $model = Settings::findOrFail($id);
        return view ('settings.edit',compact('model'));
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
        $record = Settings::findOrFail($id);
        $record->update($request->all());
        flash()->success('Edited')->important();
        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Settings::findOrFail($id);
        $record->delete();
        flash()->error('Deleted')->important();
        return back();
    }
}
