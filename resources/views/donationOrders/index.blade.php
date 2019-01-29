@extends('layouts.app')
@inject('city','App\City')
@inject('client','App\Client')
@section('page_title')
Donation Orders
@endsection

@section('content')
  

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Donation Orders</h3>

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
           	   <th>Patient name</th>
               <th class="text-center">Hospital Name</th>
               <th class="text-center">Hospital Address</th>
               <th class="text-center">City</th>
               <th class="text-center">Age</th>
               <th class="text-center">Blood Type</th>
               <th class="text-center">Number Cases</th>
               <th class="text-center">Mobile Number</th>
               <th class="text-center">Hospital Address</th>
               <th class="text-center">Notes</th>
               <th class="text-center">latitude</th>
               <th class="text-center">longitude</th>
               <th>Client name</th>
           	   <th>Delete</th>	
           	 </tr> 	
           	</thead>
           	<tbody>
           	@foreach($records as $record)
           	   <tr>
           	     <td>{{$loop->iteration}}</td>
           	     <td>{{$record->name}}</td>
                 <td>{{$record->hospital}}</td>
                 <td>{{$record->hospital_address}}</td>
                 <td>{{optional($record->city)->city}}</td>
                 <td>{{$record->age}}</td>
                 <td>{{$record->blood_type}}</td>
                 <td>{{$record->number_cases}}</td>
                 <td>{{$record->mobile_number}}</td>
                 <td>{{$record->hospital_address}}</td>
                 <td>{{$record->notes}}</td>
                 <td>{{$record->latitude}}</td>
                 <td>{{$record->longitude}}</td>
                 <td>{{optional($record->client)->name}}</td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['DonationOrderController@destroy',$record->id ] ,
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
