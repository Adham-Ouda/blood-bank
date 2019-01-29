@extends('layouts.app')
@section('page_title')
Settings
@endsection

@section('content')
  

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Settings</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="{{url(route('settings.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Settings Group</a>
        @include('flash::message')
        @if(count($records)) 
          <div class="table-responsive">
           <table class="table table-bordered">
           	<thead>
           	 <tr>
           	   <th>Settings group number</th>
           	   <th>Second Slide Content</th>
               <th class="text-center">about app</th>
               <th class="text-center">address</th>
               <th class="text-center">mobile number</th>
               <th class="text-center">phone</th>
               <th class="text-center">website</th>
               <th class="text-center">Social media channels</th>
               <th class="text-center">latitude</th>
               <th class="text-center">longitude</th>
               <th class="text-center">email</th>
               <th class="text-center">Edit</th>
               <th class="text-center">Choose</th>
           	   <th>Delete</th>	
           	 </tr> 	
           	</thead>
           	<tbody>
           	@foreach($records as $record)
           	   <tr>
           	     <td>{{$loop->iteration}}</td>
           	     <td>{{$record->second_slide}}</td>
                 <td>{{$record->about_app}}</td>
                 <td>{{$record->address}}</td>
                 <td>{{$record->mobile_number}}</td>
                 <td>{{$record->phone}}</td>
                 <td>{{$record->website}}</td>
                 <td>{{$record->social_media_channels}}</td>
                 <td>{{$record->latitude}}</td>
                 <td>{{$record->longitude}}</td>
                 <td>{{$record->email}}</td>
                 <td class="text-center">
                  <a href="{{url(route('settings.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit" >
                  </i></a>
                 </td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['Api\MainController@settings',$record->id ] ,
                  'method' => 'post'
                  ]) !!}
                  <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}  
                 </td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['SettingsController@destroy',$record->id ] ,
                  'method' => 'delete'
                  ]) !!}
                  <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}  
                 </td>
                 
           	   </tr>
           	@endforeach   	
           	</tbody>
           </table> 
           
           </form>
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
