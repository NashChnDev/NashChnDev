@extends('layouts.app')

@section('page-title','Calibrate Devices List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Calibrate Devices</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Calibrate Devices List</li>
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
          
          
               
			<div class="col-12">
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">Device Calibrate Filter</h3>
						<div class="card-tools">
                            
						</div>
					</div>
<div class="card-body">
     <div class="row">
<div class="col form-group">
    <label for="fromdate" class="col control-label">From Date</label>
    <div class="col">
    <input class="form-control" type="text" name="fromdate" id="fromdate" value="" placeholder=" ">
    </div>
</div>
    
<div class="col form-group">
    <label for="todate" class="col control-label">To Date</label>
    <div class="col">
    <input id="todate" class="form-control" type="text" name="todate" value="" placeholder=" ">
    </div>
</div>
    

<div class="col form-group">
    <label class="col control-label">Calibrate To </label>
<select class="form-control" id="calibrateto" name="calibrateto" required="">
<option value="all">All</option>
<option value="inhouse">In-House</option>
<option value="external">External</option>
</select>
</div>
         
 <div class="col form-group">
    <label class="col control-label">Device ID </label>
<select class="form-control" id="deviceid" name="deviceid" required="">
<option value="all">All</option>
 @foreach ($devicesObjects as $key => $devicesObjectsss)
    <option value="{{ $devicesObjectsss->devices_id }}">{{ $devicesObjectsss->devices_id }}</option>
@endforeach
</select>
</div>
         
 <div class="col form-group">
    <label class="col control-label">Device Catagory </label>
<select class="form-control" id="devicecatagory" name="devicecatagory" required="">
<option value="all">All</option>
 @foreach ($optionvaluesCategory as $key => $optionvaluesCategoryss)
    <option value="{{ $optionvaluesCategoryss }}">{{ $optionvaluesCategoryss }}</option>
@endforeach
</select>
</div>
         
<div class="col form-group">
    <label class="col control-label">Device Description </label>
<select class="form-control" id="devicedescription" name="devicedescription" required="">
<option value="all">All</option>
@foreach ($optionvaluesDevDescriptions as $key => $optionvaluesDevDescriptionss)
<option value="{{ $optionvaluesDevDescriptionss }}">{{ $optionvaluesDevDescriptionss }}</option>
@endforeach
</select>
</div> 
         
<div class="col form-group">
    <label class="col control-label">Calibration Status </label>
<select class="form-control" id="calibrationstatus" name="calibrationstatus" required="">
<option value="all">All</option>
<option value="Completed">Completed</option>
<option value="Pending">Pending</option>
</select>
</div>  
               
</div>
</div>
</div>
</div>
          
          
        <!-- Info boxes -->
        <div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">Devices List</h3>
						<div class="card-tools">
                            <a href="{{ route('reports.ExportCalibrationReport') }}" onclick="event.preventDefault();
									 document.getElementById('exportForm').submit();"><button style="color:#ecedf5;background-color:#3F51B5" class="btn "><i class="fa fa-download"></i> Export (Just Selected)</button></a>
                            
                            <a href="{{ route('reports.ExportAllCalibrationReport') }}"><button style="background-color:#d2e4f1" class="btn "><i class="fa fa-download"></i> Export (All)</button></a>   
						</div>
					</div>
					
						<div class="card-body table-responsive">
                            <form id="exportForm" action="{{  route('reports.ExportCalibrationReport') }}" method="GET">
							<table class="table table-sm table-hover" style="width:100%" id="devicesObjects-table">
								<thead>
									<tr>
                                        <th>Select<input name="select_all" value="1" id="devicesObjects-select-all" type="checkbox" /></th>
        <th>Devices Id</th>
		<th>Devices Category</th>
		<th>Devices Description</th>
        <th>Details Quantity</th>
        <th>Calibrate To</th>
        <th>Vendor Code</th>
        <th>Vendor Description</th>
        <th>Calibration Request No</th>
        <!--<th>Calibration Request Date</th>-->
        <th>Calibration Request By</th>
        <th>Process Status</th>
        <th>Dc No</th>
        <th>Dc Date</th>
        <th>Dc Entry By</th>
        <th>GRN No</th>
        <th>GRN Date</th>
        <th>Invoice No</th>
        <th>Invoice Date</th>
        <th>PO No</th>
        <th>PO Date</th>
        <th>Calibrated On</th>
        <th>Calibrated By</th>
        <th>Calibrated Result</th>
		<th>Device Old Status</th>
        <th>Plant Id</th>                               
		<th>Created At</th>

									</tr>
								</thead>
							</table>
                            </form>
						</div><!--/. card-body -->
				</div><!--/. card -->
			</div>
		</div> <!--/. row -->
	  </div><!--/. container-fluid -->
    </section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@push('scripts')
<!-- DataTables -->

<script>
    var reg_table;
    
    $(function() {
		reg_table = $('#devicesObjects-table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            buttons: [
            'excel'
            ],
            ajax:{"url":  '{!! route('get.calibrateReport.data') !!}',
            'data':function ( d ) {
                        d.fromdate=$("#fromdate").val();
                        d.todate=$("#todate").val();
                        d.calibrateto=$("#calibrateto").val();
                        d.deviceid=$("#deviceid").val();
                        d.devicecatagory=$("#devicecatagory").val();
                        d.devicedescription=$("#devicedescription").val();
                        d.calibrationstatus=$("#calibrationstatus").val();
                        
                       
                    }},
            columns: [
				        { data: 'calibrationreqno', name: 'calibrationreqno' },     
				        { data: 'calibrations_details_devices_id', name: 'calibrations_details_devices_id' },     
						{ data: 'calibrations_details_devicescategory', name: 'calibrations_details_devicescategory' }, 
                        { data: 'calibrations_details_devicesdescription', name: 'calibrations_details_devicesdescription' },    
                        { data: 'calibrations_details_quantity', name: 'calibrations_details_quantity' },    
                        { data: 'calibrate_to', name: 'calibrate_to' },    
                        { data: 'vendorcode_id', name: 'vendorcode_id' },    
                        { data: 'vendordescription_id', name: 'vendordescription_id' },    
                        { data: 'calibrations_details_calibrationreqno_id', name: 'calibrations_details_calibrationreqno_id' },    
                        /*{ data: 'calibrationreqdate', name: 'calibrationreqdate' },  */  
                        { data: 'calibrationreqby', name: 'calibrationreqby' },    
                        { data: 'calibrationreqstatus', name: 'calibrationreqstatus' },    
                        { data: 'dcno', name: 'dcno' },    
                        { data: 'dcdate', name: 'dcdate' },    
                        { data: 'dcentryby', name: 'dcentryby' },    
                        { data: 'calibrations_details_grnno', name: 'calibrations_details_grnno' },    
                        { data: 'calibrations_details_grndate', name: 'calibrations_details_grndate' },    
                        { data: 'invoiceno', name: 'invoiceno' },    
                        { data: 'invoicedate', name: 'invoicedate' },    
                        { data: 'pono', name: 'pono' },    
                        { data: 'podate', name: 'podate' },        
                        { data: 'calibrations_details_calibratedon', name: 'calibrations_details_calibratedon' },    
                        { data: 'calibrations_details_calibratedby', name: 'calibrations_details_calibratedby' },    
                        { data: 'calibrations_details_calibratedresult', name: 'calibrations_details_calibratedresult' },    
                        { data: 'calibrations_details_device_old_status', name: 'calibrations_details_device_old_status' },    
                        { data: 'calibrations_details_plant_id', name: 'calibrations_details_plant_id' },       
						{ data: 'created_at', name: 'created_at' },     

            ],
                                             "aoColumnDefs": [

                    {
                        "aTargets" : [10],
                        "mData"    : null,
                        "mRender"  : function(data, type, full) {
                                if(data == 'Pending')
                        	       return '<small class="badge badge-danger">'+data+'</small>';
                                else if(data == 'Completed')
                                    return '<small class="badge badge-success">'+data+'</small>';
                                
            
            
                        }
                    },
                              {
                         'targets': 0,
                        'searchable': false,
                        'orderable': false,    
                        "mRender"  : function(data, type, full) {
                               // console.log(full['devices_id']);
                            return '<input type="checkbox" name="selectExport[]" value="' +full['calibrationreqno']+ '">';
                        }
                    }
                ] 
        })
    
    
    
           // Handle click on "Select all" control
   $('#devicesObjects-select-all').on('click', function(){
      // Get all rows with search applied
      var rows = reg_table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#devicesObjects tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#devicesObjects-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

   // Handle form submission event
   $('#frm-devicesObjects').on('submit', function(e){
      var form = this;
      // Iterate over all checkboxes in the table
      reg_table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         }
      });
   });
    
    
    });
    
    
$("#fromdate").datepicker({dateFormat: 'dd/mm/yy'});
$("#todate").datepicker({dateFormat: 'dd/mm/yy'});
$("#calibrateto").datepicker({dateFormat: 'dd/mm/yy'});

$("#fromdate,#todate,#calibrateto,#deviceid,#devicecatagory,#devicedescription,#calibrationstatus").on('change',function(){
    reg_table.draw();
});

</script>
@endpush