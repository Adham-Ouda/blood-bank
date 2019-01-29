<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticlesCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $records = ArticlesCategory::paginate(20);
        return view('categories.index',compact('records')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
         'category_name' => 'required'
       ];

       $messages = [
        'category_name.required' => 'Category Name is required'
       ];

        $this->validate($request,$rules,$messages);

        $record = new ArticlesCategory;
        $record->category_name = $request->input('category_name');
        $record->save();
        
        //flash('Message')->success(): Set the flash theme to "success".
        //flash('Message')->important(): Add a close button to the flash message.
        
        flash()->success('Success')->important();

        //$record = Governorate::create($request->all());

         return redirect(route('category.index')); 
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
        $model = ArticlesCategory::findOrFail($id);
        return view ('categories.edit',compact('model'));
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
        $record = ArticlesCategory::findOrFail($id);
        $record->update($request->all());
        flash()->success('Edited')->important();
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = ArticlesCategory::findOrFail($id);
        $record->delete();
        //from laravelcollective docimentation flash('Message')->error(): Set the flash theme to "danger".
        flash()->error('Deleted')->important();
        return back();
    }
}
