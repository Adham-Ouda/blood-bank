@extends('layouts.app')
@inject('client','App\Client')
@section('page_title')
Reports
@endsection

@section('content')
  

    <!-- Main content -->
    <section class="content">
     
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Reports</h3>

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
               <th class="text-center">text</th>
               <th class="text-center">mobile number</th>
           	   <th>Delete</th>	
           	 </tr> 	
           	</thead>
           	<tbody>
           	@foreach($records as $record)
           	   <tr>
           	     <td>{{$loop->iteration}}</td>
           	     <td>{{optional($record->client)->name}}</td>
                 <td>{{$record->text}}</td>
                 <td>{{optional($record->client)->mobile_number}}</td>
                 <td class="text-center">
                 {!! Form::open([
                  'action' => ['ReportController@destroy',$record->id ] ,
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
