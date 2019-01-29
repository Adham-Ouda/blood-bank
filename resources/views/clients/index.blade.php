@extends('layouts.app')
@inject('city','App\City')
@section('page_title')
Clients
@endsection

@section('content')
  

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Clients</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        @include('flash::message')
        @if(count($records)) 
          <div class="table-responsive">
           <table class="table table-bordered">
           	<thead>
           	 <tr>
           	   <th>#</th>
           	   <th>Name</th>
               <th class="text-center">Email</th>
               <th class="text-center">Birth Date</th>
               <th class="text-center">City</th>
               <th class="text-center">mobile number</th>
               <th class="text-center">Last donation date</th>
               <th class="text-center">Blood Type</th>
           	   <th>Delete</th>	
           	 </tr> 	
           	</thead>
           	<tbody>
           	@foreach($records as $record)
           	   <tr>
           	     <td>{{$loop->iteration}}</td>
           	     <td>{{$record->name}}</td>
                 <td>{{$record->email}}</td>
                 <td>{{$record->birth_date}}</td>
                 <td>{{optional($record->city)->city}}</td>
                 <td>{{$record->mobile_number}}</td>
                 <td>{{$record->last_donation_date}}</td>
                 <td>{{$record->blood_type}}</td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['ClientController@destroy',$record->id ] ,
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
