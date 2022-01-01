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
         
</div>
<div class="row">      
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
    <label class="col control-label">Device Usage Location </label>
<select class="form-control" id="deviceusagelocation" name="deviceusagelocation" required="">
<option value="all">All</option>
@foreach ($optionvaluesUsage_Location as $key => $optionvaluesUsage_Locationss)
<option value="{{ $optionvaluesUsage_Locationss }}">{{ $optionvaluesUsage_Locationss }}</option>
@endforeach
</select>
</div> 
    
<div class="col form-group">
    <label class="col control-label">Issue Status </label>
<select class="form-control" id="issuestatus" name="issuestatus" required="">
<option value="all">All</option>
<option value="1">Completed</option>
<option value="0">Pending</option>

</select>
</div>  
    
<div class="col form-group">
    <label class="col control-label">Return Status </label>
<select class="form-control" id="returnstatus" name="returnstatus" required="">
<option value="all">All</option>
<option value="1">Completed</option>
<option value="0">Pending</option>
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
                            <a href="{{ route('reports.ExportdeviceRIRReport') }}" onclick="event.preventDefault();
									 document.getElementById('exportForm').submit();"><button style="color:#ecedf5;background-color:#3F51B5" class="btn "><i class="fa fa-download"></i> Export (Just Selected)</button></a>
                            
                            <a href="{{ route('reports.ExportAlldeviceRIRReport') }}"><button style="background-color:#d2e4f1" class="btn "><i class="fa fa-download"></i> Export (All)</button></a>  
						</div>
					</div>
					
						<div class="card-body table-responsive">
                            <form id="exportForm" action="{{  route('reports.ExportdeviceRIRReport') }}" method="GET">
							<table class="table table-sm table-hover" style="width:100%" id="devicesObjects-table">
								<thead>
									<tr>
                                        <th>Select<input name="select_all" value="1" id="devicesObjects-select-all" type="checkbox" /></th>
        <th>Devices Id</th>
        <th>Devices Category</th>
        <th>Devices Description</th>
        <th>Devices Usage Location</th>
        <th>Req No</th>
        <th>Req Date</th>
        <th>Req Created By</th>
        <th>Req Entry Date</th>
        <th>Issue Process</th>
        <th>Issue No</th>
        <th>Issue Date</th>
        <th>Issue Created By</th>
        <th>Issue Entry Date</th>
        <th>Return Process</th>
        <th>Return No</th>
        <th>Return Date</th>
        <th>Return By</th>
        <th>Return Created By</th>
        <th>Return Entry Date</th>                            
        <th>Created At</th>
        <th>Plant Id</th>
		

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
            ajax:{"url":  '{!! route('get.deviceRIR_Report.data') !!}',
            'data':function ( d ) {
                        d.fromdate=$("#fromdate").val();
                        d.todate=$("#todate").val();
                        d.deviceid=$("#deviceid").val();
                        d.devicecatagory=$("#devicecatagory").val();
                        d.devicedescription=$("#devicedescription").val();
                        d.deviceusagelocation=$("#deviceusagelocation").val();
                        d.issuestatus=$("#issuestatus").val();
                        d.returnstatus=$("#returnstatus").val();
                        
                       
                    }},
            columns: [
                          { data: 'gaugereqno_id', name: 'gaugereqno_id' },                                
				        { data: 'devices_id', name: 'devices_id' },     
						{ data: 'devicescategory', name: 'devicescategory' }, 
                        { data: 'devicesdescription', name: 'devicesdescription' },    
                        { data: 'device.devices_storgelocation', name: 'devices_storgelocation' },    
                        { data: 'gaugereqno_id', name: 'gaugereqno_id' },    
                        { data: 'gaugereqdate', name: 'gaugereqdate' },    
                        { data: 'createdby', name: 'createdby' },    
                        { data: 'entrydate', name: 'entrydate' },    
                        { data: 'issue_entry', name: 'issue_entry' },    
                        { data: 'issue_reqlist.gaugeissueno', name: 'gaugeissueno' },    
                        { data: 'issue_reqlist.gaugeissuedate', name: 'gaugeissuedate' },    
                        { data: 'issue_reqlist.createdby', name: 'createdby' },    
                        { data: 'issue_reqlist.entrydate', name: 'entrydate' },    
                        { data: 'issue_reqlist.return_entry', name: 'return_entry' },    
                        { data: 'return_reqlist.gaugereturnno_id', name: 'gaugereturnno_id' },    
                        { data: 'return_reqlist.gaugereturndate', name: 'gaugereturndate' },    
                        { data: 'return_reqlist.returnby', name: 'returnby' },    
                        { data: 'return_reqlist.createdby', name: 'createdby' },    
                        { data: 'return_reqlist.entrydate', name: 'entrydate' },    
                        { data: 'created_at', name: 'created_at' },    
                        { data: 'plant_id', name: 'plant_id' },        
                      

            ],
                                             "aoColumnDefs": [

                    {
                        "aTargets" : [10,11,12,13,15,16,17,18,19],
                        "mData"    : null,
                        "mRender"  : function(data, type, full) {
                                //console.log(full['issue_entry'])
                                if (data !== undefined) {
                                    return data; 
                                        }
                                else{
                                        return '-';
                                    }
                                
            
            
                        }
                    },
      {
                        "aTargets" : [9],
                        "mData"    : null,
                        "mRender"  : function(data, type, full) {
                                if(full['issue_entry'] == 0)
                                    {
                                        return '<small class="badge badge-danger">Pending</small>';
                                    }
                                else if(full['issue_entry'] == 1)
                                    {
                                        return '<small class="badge badge-success">Completed</small>';
                                    }
                                return '';
                                
            
            
                        }
                    },
      
      {
                        "aTargets" : [14],
                        "mData"    : null,
                        "mRender"  : function(data, type, full) {
                          //  console.log(full.issue_reqlist.return_entry)
                           // console.log(data)
                                if(data == 0)
                                    {
                                        return '<small class="badge badge-danger">Pending</small>';
                                    }
                                else if(data == 1)
                                    {
                                        return '<small class="badge badge-success">Completed</small>';
                                    }
                               else if(data == undefined)
                                    {
                                        return '-';
                                    }
                                return '';
                                
            
            
                        }
                    },
                        {
                         'targets': 0,
                        'searchable': false,
                        'orderable': false,    
                        "mRender"  : function(data, type, full) {
                               // console.log(full['devices_id']);
                            return '<input type="checkbox" name="selectExport[]" value="' +full['gaugereqno_id']+ '">';
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

$("#fromdate,#todate,#calibrateto,#deviceid,#devicecatagory,#devicedescription,#deviceusagelocation,#issuestatus,#returnstatus").on('change',function(){
    reg_table.draw();
});

</script>
@endpush