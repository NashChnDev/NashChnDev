@extends('layouts.app')

@section('page-title','')

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
            <h1 class="m-0 text-dark">Employee Joining Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Employee Joining Details</li>
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
				    		<h3 class="card-title clearfix">Employee Joining Details</h3>
                <div class="card-tools">
                  <!-- <a href="" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New JoiningForm"  role="button">
                    <span class="fa fa-plus" aria-hidden="true">Interview Schedule</span>
                  </a> -->
                  <button type="button" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" data-toggle="modal" data-target="#joiningform">
                  <span class="fa fa-plus" aria-hidden="true">New Employee</button>
                  <!-- <a role="button" href="{{ route('joiningform.joiningform.nashemployee') }}" class="btn btn-sm pl-3 pr-3 bg-warning clearfix" > -->
                  
                  {{-- <a role="button" href="{{ route('employees.employee.index') }}" class="btn btn-sm pl-3 pr-3 bg-warning clearfix" >
                  <span class="fa fa-eye" aria-hidden="true">Nash Employee</a> --}}
                </div>
				    	</div>
					<!-- <div style="float:right;padding:10px;font-size:20px;"><spanclass="existingemp"><span>Nash Employee :</span><label class="switch"><input type="checkbox" id="pg_marksheet" class="checkboxchecked"><span class="slider round"></span></label><span></div> -->
				  		<div class="card-body table-responsive">              
						  	<table class="table table-sm table-hover" style="width:100%" id="employee_joining_table">
								<thead>
									<tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Location</th>
		                  <th>Department</th>
		                  <th>Designation</th>
		                  <th>InterviewDate</th>
		                  <th>JoiningDate</th>		                 
											<th>Action</th>
                      <th>Status</th>
									</tr>
								</thead>
                </table>
                <table class="table table-sm table-hover" style="width:100%;display:none" id="employee_exisiting_table">
								<thead>
									<tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>EmployeeID</th>
		                  <th>Designation</th>
		                  
											<th>Action</th>
                      <th>Status</th>
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


  <div class="modal fade" id="CheckListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Check List</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        </div>        
      </div>
    </div>
  </div>
  <div class="modal fade" id="joiningform" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Employee</h5>
        <button type="button" class="close" onClick="window.location.reload()" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>          
      <div class="modal-body">
        
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
              <label for="exampleInputPassword1">Email ID*</label>
              <input type="text" class="form-control" id="emailid"  placeholder="Email*">
               <small id="erroremail" class="form-text text-muteds" style="display:none">Please Check Email</small>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
              <label for="exampleInputPassword1">Mobile No*</label>
              <input type="text" class="form-control" id="mobile"  placeholder="MobileNo*">
               <small id="erroremail" class="form-text text-muteds" style="display:none">Please Check Email</small>
              </div>
            </div> 
            <div class="col-md-4">
              <div class="form-group">
              <label for="exampleInputPassword1">Joining Location*</label>
              {{-- <input type="text" class="form-control" id="joininglocation"  placeholder="Joining Location*"> --}}
              @if(!empty($plants))
              <select class="form-control" id="joininglocation">
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
                <label for="exampleInputPassword1">Department*</label>
               
                <select class="form-control" id="department">
                  <option value="">Select department</option>                 
                </select>
                <small id="errordepartment" class="form-text text-muteds" style="display:none">Please Check Department</small>
              </div>  
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Area</label>
                {{-- <input type="text" class="form-control" id="department" placeholder="Department*"> --}}
                <select class="form-control" id="area">
                  <option value="">Select Area</option>                 
                </select>
                <small id="errordepartment" class="form-text text-muteds" style="display:none">Please Check Department</small>
              </div>  
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">SubArea</label>
                {{-- <input type="text" class="form-control" id="department" placeholder="Department*"> --}}
                <select class="form-control" id="subarea">
                  <option value="">Select Sub Area</option>                 
                </select>
                <small id="errordepartment" class="form-text text-muteds" style="display:none">Please Check Department</small>
              </div>  
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Designation*</label> 
                {{-- <input type="text" class="form-control" id="designation" placeholder="Designation*"> --}}
                <select class="form-control" id="designation" name="current_designation">
                  <option value="">Select Designation</option>
                    @foreach($drop_downs as $keys => $vals)
                      @if($vals['fieldsname']=='designation')
                      <option value="{{ $vals['optionvalue'] }}">{{ $vals['optionvalue'] }}</option>
                      @endif
                    @endforeach
                </select>
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please Check Designation</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Function*</label> 
                {{-- <input type="text" class="form-control" id="designation" placeholder="Designation*"> --}}
                <select class="form-control" id="functions" name="current_function">
                  <option value="">Select Function</option>
                    @foreach($drop_downs as $keys => $vals)
                      @if($vals['fieldsname']=='functions')
                      <option value="{{ $vals['optionvalue'] }}">{{ $vals['optionvalue'] }}</option>
                      @endif
                    @endforeach
                </select>
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please Check Designation</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Cost Center*</label> 
                {{-- <input type="text" class="form-control" id="designation" placeholder="Designation*"> --}}
                <select class="form-control" id="cost_center" name="current_costcenter">
                  <option value="">Select Cost Center</option>
                    @foreach($drop_downs as $keys => $vals)
                      @if($vals['fieldsname']=='Costcenter')
                      <option value="{{ $vals['optionvalue'] }}">{{ $vals['optionvalue'] }}</option>
                      @endif
                    @endforeach
                </select>
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please Check Designation</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Current_Gross_Salary</label> 
                <input type="text" class="form-control" id="gross_salary" placeholder="gross_salary">                
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please gross_salary</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Current_ctc_Salary</label> 
                <input type="text" class="form-control" id="ctc_salary" placeholder="ctc_salary">                
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please ctc_salary</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputPassword1">Bonus</label> 
                <input type="text" class="form-control" id="bonus" placeholder="bonus">                
                <small id="errordesignation" class="form-text text-muteds" style="display:none">Please Bonus</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="exampleInputPassword1">Date of Interview</label>
              <input type="text" class="form-control datepicker" id="interviewdate" placeholder="Date of Interview">
              <small id="errorinterview" class="form-text text-muteds" style="display:none">Please Check Interview</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="exampleInputPassword1">Date of Joining</label> 
              <input type="text" class="form-control datepicker" id="interviewjoining" placeholder="Date of Joining">
              <small id="errorjoining" class="form-text text-muteds" style="display:none">Please Check Interviewjoining</small>
            </div>
            </div>
          
            
        </div>
      </div>
      <div class="modal-footer">
        <span id="error" style="color: red;font-size:14px"></span>
        <span id="success" style="color:gray;font-size:14px"></span>
         <button type="button" class="btn btn-primary saveemployee" >Save Employee</button>
        {{-- <button type="button" id="redirect_joining" class="btn btn-success saveemployee" >Add Joining Details</button> --}}
      </div>         
      
    </div>
   </div>
  </div>
  <div class="modal" id="maillink" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mail Link</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        </div>      
      </div>
    </div>
  </div>
  <div class="modal" id="activatelink" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Activate Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-group">
          <input type="hidden" id="empcodeId" >
              <label for="exampleInputPassword1">Employee Code</label>
              <input type="text" class="form-control " id="Employeecode" placeholder="Please Enter EmployeeCode">         
            </div>      
            <div class="form-group" style="text-align:center">   
            <button type="button" class="btn btn-primary saveactivateemployee" >Save Employee Code</button>
            </div>
        </div>      
        
      </div>
    </div>
  </div>
  <div class="modal fade" id="exisitingform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">New Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
        <div class="modal-body col-md-12 row">   
        
          <div class="col-md-6">
            <div class="form-group">
              <!-- <label for="exampleInputEmail1">Name*</label> -->
              <input type="text" class="form-control" id="names"  placeholder="Name*">
              <small id="errornames" class="form-text text-muteds" style="display:none">Please Check Name</small>
            </div>          
            <div class="form-group">
              <!-- <label for="exampleInputEmail1">Name*</label> -->
              <input type="text" class="form-control" id="empid"  placeholder="EmployeeID*">
              <small id="errorempids" class="form-text text-muteds" style="display:none">Please Check EmployeeID</small>
            </div>          
          </div>  
          <div class="col-md-6">
          <div class="form-group">            
              <input type="text" class="form-control" id="designations" placeholder="Designation*">
              <small id="errordesignations" class="form-text text-muteds" style="display:none">Please Check Designation</small>
            </div>          
            <div class="form-group">
              <!-- <label for="exampleInputPassword1">Email ID*</label> -->
              <input type="text" class="form-control" id="emailide"  placeholder="Email*">
              <small id="erroremails" class="form-text text-muteds" style="display:none">Please Check Email</small>
            </div>  
          </div>                  
        </div>
        <div class="form-group" style="display:none" id="successmsg">
            <span>Successfully Updated</span>
        </div> 
        
        
        <div class="modal-footer">
          <button type="button" class="btn btn-primary saveexistingemployee" >Save Employee</button>
          <button type="button" id="redirect_joining" class="btn btn-success saveexistingemployee" >Add Personal Details</button>
        </div>                   
        </form>
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
		activTable = $('#employee_joining_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {data:{"exisiting":"no"},url:'joiningform/joiningformdata'},
            columns: [
              { data: 'id', name: 'id' },
                  { data: 'name', name: 'name'},
                  { data: 'email_id', name: 'email_id' },
                  { data: 'joininglocation', name:'joininglocation' },
                  { data: 'department', name: 'department' },     
                  { data: 'designation', name: 'designation' },     
                  { data: 'date_of_interview', name: 'date_of_interview' },     
                  { data: 'date_of_joining', name: 'date_of_joining' },     
                  { data: 'actions', name: 'actions', orderable: false, searchable: false},
                  { data: 'progressbar', name: 'progressbar' }
            ]                                                  
        });
    });
   
    
    
    //     $(document).on('click','#sub_button',function(){
    //     var tr = $(this).closest('tr');
    //     var row = activTable.row(tr);
        
    //     console.log(row.data());
    //     var tableId = 'subs-' + row.data().id;

    //     if (row.child.isShown()) {
    //         row.child.hide();
    //         tr.find(".btn:first").removeClass('btn-danger');
    //         tr.find(".btn:first").addClass('btn-success');
    //         tr.find(".fa").addClass('fa-plus');
    //         tr.find(".fa").removeClass('fa-minus');
    //     } else {
    //         row.child(template(row.data())).show();
    //         initTable(tableId, row.data());
    //         tr.find(".btn:first").removeClass('btn-success');
    //         tr.find(".btn:first").addClass('btn-danger');
    //         tr.find(".fa").addClass('fa-minus');
    //         tr.find(".fa").removeClass('fa-plus');
    //         tr.next().find('td').addClass('no-padding bg-gray'); 
    //     }
    // });

//     function initTable(tableId, data) {
//         console.log(data);
//         subtable=$('#' + tableId+' > tbody');
// //        data.issuedevice_list.forEach(dev=>{
// //        subtable.fnAddData( [
// //       dev.devices_id,
// //       dev.devicescategory,
// //       dev.devicesdescription,
// //       dev.deviceserpcode
// //        ] );    
// //        })
//         subtable.html('');
//         data.devicelist.forEach(dev=>{
//             console.log(dev)
//             subtable.append('<tr><td>'+dev.devices_id+'</td><td>'+dev.devicescategory+'<td>'+dev.devicesdescription+'</td><td>'+dev.deviceserpcode+'</td><td>'+dev.devicesnextcalidate+'</td></tr>')
//         })
        
//     }

var joiningdetail = new joiningindex('joiningindex');  
</script>


@endpush