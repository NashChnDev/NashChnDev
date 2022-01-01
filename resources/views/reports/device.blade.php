@extends('layouts.app')

@section('page-title','Devices List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Devices</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Devices List</li>
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
						<h3 class="card-title clearfix">Device Filter</h3>
						<div class="card-tools">
                            
						</div>
					</div>
<div class="card-body">
     <div class="row">
<div class="col form-group">
    <label for="fromdate" class="col control-label">Created From Date</label>
    <div class="col">
    <input class="form-control" type="text" name="fromdate" id="fromdate" value="" placeholder=" ">
    </div>
</div>
    
<div class="col form-group">
    <label for="todate" class="col control-label">Created To Date</label>
    <div class="col">
    <input id="todate" class="form-control" type="text" name="todate" value="" placeholder=" ">
    </div>
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
         
</div>
    
<div class="row">        
<div class="col form-group">
    <label class="col control-label">Device Usage Location </label>
<select class="form-control" id="deviceusagelocation" name="deviceusagelocation" required="">
<option value="all">All</option> 
@foreach ($optionvaluesUsage_Location as $key => $optionvaluesUsage_Locationss)
<option value="{{ $optionvaluesUsage_Locationss }}">{{ $optionvaluesUsage_Locationss }}</option>
@endforeach
</select>
</div>
         
<div class="col form-group">
    <label for="devicepurchasefromdate" class="col control-label">Purchase From Date</label>
    <div class="col">
    <input id="devicepurchasefromdate" class="form-control" type="text" name="devicepurchasefromdate" value="" placeholder=" ">
    </div>
</div>
         
<div class="col form-group">
    <label for="todate" class="col control-label">Purchase To Date</label>
    <div class="col">
    <input id="devicepurchasetodate" class="form-control" type="text" name="devicepurchasetodate" value="" placeholder=" ">
    </div>
</div>
         
<div class="col form-group">
    <label for="status" class="col control-label">Device Status</label>
    <div class="col">

<select class="form-control" id="status" name="status" >
<option value="all">All</option>
<option value="idle">Idle</option>
<option value="inuse">Inuse</option>
<option value="damage">Damage</option>
<option value="Approach_Calibration">Approach Calibration</option>
<option value="Expired">Expired</option>
<option value="calibrate_Request">Calibrate Request</option>
<option value="scrap_Request">Scrap Request</option>
<option value="scrap">Scrap</option>
<option value="Scraped">Scraped</option>
 
</select>
    </div>
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
						<h3 class="card-title clearfix">Devices</h3>
						<div class="card-tools">
                          <a href="{{ route('reports.ExportdeviceReport') }}" onclick="event.preventDefault();
									 document.getElementById('exportForm').submit();"><button style="color:#ecedf5;background-color:#3F51B5" class="btn "><i class="fa fa-download"></i> Export (Just Selected)</button></a>
                            
                            <a href="{{ route('reports.ExportAlldeviceReport') }}"><button style="background-color:#d2e4f1" class="btn "><i class="fa fa-download"></i> Export (All)</button></a>   
						</div>
					</div>
					
						<div class="card-body table-responsive">
                            <form id="exportForm" action="{{  route('reports.ExportdeviceReport') }}" method="GET">
							<table class="table table-sm table-hover" style="width:100%" id="devicesObjects-table">
								<thead>
									<tr>
                                <th>Select<input name="select_all" value="1" id="devicesObjects-select-all" type="checkbox" /></th>
        <th>Devices ID</th>
		<th>Device Category</th>
        <th>Devices Description</th>
		<th>Device Asset/ERP code</th>
		<th>Device Size/Range</th>
		<th>Date of Purchase</th>
		<th>Last calibration Date</th>
		<th>Next calibration Date</th>
		<th>Device Alert Days</th>
		<th>Alert Date</th>
		<th>Status</th>
		<th>created_at</th>

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
            ajax:{"url":  '{!! route('get.devicesReport.data') !!}',
            'data':function ( d ) {
                        d.fromdate=$("#fromdate").val();
                        d.todate=$("#todate").val();
                        d.devicecatagory=$("#devicecatagory").val();
                        d.devicedescription=$("#devicedescription").val();
                        d.deviceusagelocation=$("#deviceusagelocation").val();
                        d.devicepurchasefromdate=$("#devicepurchasefromdate").val();
                        d.devicepurchasetodate=$("#devicepurchasetodate").val();
                        d.status=$("#status").val();
                       
                    }},
            columns: [
                                                         
				        { data: 'id', name: 'id' },     
				        { data: 'devices_id', name: 'devices_id' },     
						{ data: 'device_scategory', name: 'device_scategory' }, 
                        { data: 'devices_description', name: 'devices_description' },    
						{ data: 'device_sasseterpcode', name: 'device_sasseterpcode' },     
						{ data: 'devices_sizerange', name: 'devices_sizerange' },                       
						{ data: 'devices_dateofpurchase', name: 'devices_dateofpurchase' },     
						{ data: 'lastcalibrationdate', name: 'lastcalibrationdate' },     
						{ data: 'expirydate', name: 'expirydate' },           
						{ data: 'devices_alerydays', name: 'devices_alerydays' },     
						{ data: 'alert_remaindate', name: 'alert_remaindate' },    
						{ data: 'status', name: 'status' },     
						{ data: 'created_at', name: 'created_at' },     

            ],
                                             "aoColumnDefs": [

                    {
                        "aTargets" : [11],
                        "mData"    : null,
                        "mRender"  : function(data, type, full) {
                                if(data == 'scrap')
                        	       return '<small class="badge badge-danger">'+data+'</small>';
                                else if(data == 'idle')
                                    return '<small class="badge badge-success">'+data+'</small>';
                                else if(data == 'inuse')
                                    return '<small class="badge badge-warning">'+data+'</small>';
                                else if(data == 'damage')
                                    return '<small class="badge badge-info">'+data+'</small>';
                                else if(data == 'Approach_Calibration')
                                    return '<small class="badge badge-secondary">'+data+'</small>'; 
                                else if(data == 'Expired')
                                    return '<small class="badge badge-dark">'+data+'</small>';
                                else if(data == 'Scraped')
                                    return '<small class="badge badge-danger">'+data+'</small>';
                                else if(data == 'calibrate_Request')
                                    return '<small class="badge badge-light" >'+data+'</small>';
                                else if(data == 'scrap_Request')
                                    return '<small class="badge badge-danger" >'+data+'</small>';
            
            
                        }
                    },
                        {
                         'targets': 0,
                        'searchable': false,
                        'orderable': false,    
                        "mRender"  : function(data, type, full) {
                               // console.log(full['id']);
                            return '<input type="checkbox" name="selectExport[]" value="' +full['id']+ '">';
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
$("#devicepurchasefromdate").datepicker({dateFormat: 'dd/mm/yy'});
$("#devicepurchasetodate").datepicker({dateFormat: 'dd/mm/yy'});
    


$("#fromdate,#todate,#devicecatagory,#devicedescription,#deviceusagelocation,#devicepurchasefromdate,#devicepurchasetodate,#status").on('change',function(){
    reg_table.draw();
});

</script>
@endpush