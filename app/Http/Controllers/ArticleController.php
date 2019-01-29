<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Article ;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$records = Article::paginate(20);
        $records = Article::with('articlesCategory')->get();
        // return $records;
        return view('articles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create'); 
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
         'title' => 'required' ,
         'body' => 'required'
       ];

       $messages = [
        'title.required' => 'Title is required' ,
        'body.required' => 'Body is required'
       ];

        $this->validate($request,$rules,$messages);

        $record = new Article;
        $record->title = $request->input('title');
        $record->body = $request->input('body');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
       $image_name = time().'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path('/images');
       $image->move($destinationPath, $image_name);
        $record->image = '/images/'.$image_name; 
        }
        $record->articles_category_id = $request->input('articles_category_id');
        $record->save();
        
        flash()->success('Success')->important();


         return redirect(route('article.index'));
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
        $model = Article::findOrFail($id);
        return view ('articles.edit',compact('model'));
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
        $record = Article::findOrFail($id);
        //$record->update($request->all());
        $record->title = $request->input('title');
        $record->body = $request->input('body');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
       $image_name = time().'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path('/images');
       $image->move($destinationPath, $image_name);
        $record->image = '/images/'.$image_name; 
        }
        $record->articles_category_id = $request->input('articles_category_id');
        $record->save();
        flash()->success('Edited')->important();
        return redirect(route('article.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Article::findOrFail($id);
        $record->delete();
        flash()->error('Deleted')->important();
        return back();
    }
}
