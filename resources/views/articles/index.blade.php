@extends('layouts.app')
@section('page_title')
Articles
@endsection

@section('content')
  

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Articles</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="{{url(route('article.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Articles</a>
        @include('flash::message')
        @if(count($records)) 
          <div class="table-responsive">
           <table class="table table-bordered">
           	<thead>
           	 <tr>
           	   <th>#</th>
           	   <th>Title</th>
           	   <th class="text-center">Body</th>
               <th class="text-center">image</th>
               <th class="text-center">Category Name</th>
               <th class="text-center">Edit</th>
           	   <th>Delete</th>	
           	 </tr> 	
           	</thead>
           	<tbody>
           	@foreach($records as $record)
           	   <tr>
           	     <td>{{$loop->iteration}}</td>
           	     <td>{{$record->title}}</td>
                 <td>{{$record->body}}</td>
                 <td><img src="{{asset($record->image)}}" width="50" height="50"> </td>
                 <td>{{optional($record->articlesCategory)->category_name}}</td>
           	     <td class="text-center">
                  <a href="{{url(route('article.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit" >
                  </i></a>
                 </td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['ArticleController@destroy',$record->id ] ,
                  'method' => 'delete'
                  ]) !!}
                  <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}  
                 </td>
           	   </tr>
           	@endforeach   	
           	</tbody>
           </table> 
          </div>
          @else
          <div class="alert alert-danger" role="alert">
                    No data
          </div>
          @endif
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
