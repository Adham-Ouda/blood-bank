<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;


class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = ContactUs::paginate(20);
        return view('contactUs.index',compact('records'));
    }

   
    public function destroy($id)
    {
        $record = ContactUs::findOrFail($id);
        $record->delete();
        flash()->error('Deleted')->important();
        return back();
    }
}
