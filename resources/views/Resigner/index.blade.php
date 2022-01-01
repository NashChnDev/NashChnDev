@extends('layouts.app')

@section('page-title','Resigner List')

@section('content')
<style>
  input,select {
    border-radius: 0px !important;
}
.modal {
    color: #003e74;
}
.modal label {
    font-weight: 400 !important;
}
</style>
{{-- <link rel="stylesheet" href="{{ URL::asset('css/nashemploye.css') }}" /> --}}
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Employee Resigner Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Employee Resigner Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<!--@if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
       </div>
    @endif-->
    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
	    		<div class="col-12">
		    		<div class="card card-primary card-outline">
				      <div class="card-header">
				    		<h3 class="card-title clearfix">Employee Resigner Details</h3>
                <div class="card-tools">
                  <!-- <a href="" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New JoiningForm"  role="button">
                    <span class="fa fa-plus" aria-hidden="true">Interview Schedule</span>
                  </a> -->
                  <button type="button" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" data-toggle="modal" data-target="#resiginingform">
                  <span class="fa fa-plus" aria-hidden="true">Add Employee</button>
               
                </div>
				    	</div>
					<!-- <div style="float:right;padding:10px;font-size:20px;"><spanclass="existingemp"><span>Nash Employee :</span><label class="switch"><input type="checkbox" id="pg_marksheet" class="checkboxchecked"><span class="slider round"></span></label><span></div> -->
				  		<div class="card-body table-responsive">              
						  	<table class="table table-sm table-hover" style="width:100%" id="employee_resigning_table">
								<thead>
									<tr>                  
                      <th>Name</th>
                      <th>Employee Code</th>
                      <th>Plant</th>
		                  <th>Department</th>
		                  <th>Resign Applied Date</th>
                          <th>Reason</th>
                          <th>Action</th>
		                  
									</tr>
								</thead>
                </table>
           
						  </div><!--/. card-body -->
				    </div><!--/. card -->
		    	</div>
	    	</div> <!--/. row -->
  	   </div><!--/. container-fluid -->
    </section>   
	<!-- /.content -->
  </div>

  <div class="modal fade" id="resiginingform" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Resigning Form</h5>
                <button type="button" class="close" onClick="window.location.reload()" >
                <span aria-hidden="true">&times;</span>
                </button>
            </div>          
            <div class="modal-body" id="resigner_form">        
                    <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name*</label> 
                            <input type="text" class="form-control" id="name"  placeholder="Name*">
                            <small id="errorname" class="form-text text-muteds" style="display:none">Please Check Name</small>                
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee Code*</label> 
                                <input type="text" class="form-control" id="empcode"  placeholder="Employee Code*">
                                <small id="errorname" class="form-text text-muteds" style="display:none">Please Check Name</small>                
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Plant*</label>
                        {{-- <input type="text" class="form-control" id="joininglocation"  placeholder="Joining Location*"> --}}
                        @if(!empty($plants))
                        <select class="form-control" id="plant">
                            <option value="">Select Plant</option>
                            @foreach ($plants as $plant_det)
                                <option>{{ $plant_det['plantcode'] }}
                            @endforeach
                        </select>
                        @endif
                        <small id="erroremail" class="form-text text-muteds" style="display:none">Please Check Email</small>
                        </div>
                        </div> 
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Department*</label>
                            {{-- <input type="text" class="form-control" id="department" placeholder="Department*"> --}}
                            <select class="form-control" id="department">
                            <option value="">Select department</option>                 
                            </select>
                            <small id="errordepartment" class="form-text text-muteds" style="display:none">Please Check Department</small>
                        </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Resignation Applied Date</label> 
                            <input type="text" id="resigned_date" class="form-control datepicker" id="interviewjoining" placeholder="Date of Joining">
                            <small id="errorjoining" class="form-text text-muteds" style="display:none">Please Check Interviewjoining</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="">Reason for Resigned</label> 
                            <textarea class="form-control" id="reason_for_resigned"></textarea>   
                        </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <span id="error" style="color: red;font-size:14px"></span>
                        <span id="success" style="color:gray;font-size:14px"></span>
                        <button type="button" class="btn btn-primary saveresigner" >Save Employee</button>
                        {{-- <button type="button" id="redirect_joining" class="btn btn-success saveemployee" >Add Joining Details</button> --}}
                    </div>         
            </div>
                
        </div>
    </div>
</div>
  
  <!-- /.content-wrapper -->
@endsection



@push('scripts')
<!-- DataTables -->

<script src="{{asset('js/handlebars-v4.1.2.js')}}"></script>
<script id="accomodation-template" type="text/x-handlebars-template">
      
    </script>
<style>

</style>


<!-- Modal -->







<script>
  
  var DataTable,inactive_DataTable;
    var activTable ;
    var template = Handlebars.compile($("#accomodation-template").html());    
    
    $(function() {
		activTable = $('#employee_resigning_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {url:'resignerlist/resignerdata'},
            columns: [             
                  { data: 'name', name: 'name'},
                  { data: 'empcode', name: 'empcode' },
                  { data: 'plant', name:'plant' },
                  { data: 'department', name: 'department' },     
                  { data: 'resigned_date', name: 'resigned_date' },     
                  { data: 'reason_for_resigned', name: 'reason_for_resigned' },
                  { data: 'actions', name: 'actions', orderable: false, searchable: false},                 
                  
            ]                                                  
        });
    });
   
    
var Resignerdetails = new resignerindex('joiningindex');  
</script>


@endpush