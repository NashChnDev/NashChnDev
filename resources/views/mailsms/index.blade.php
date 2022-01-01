@extends('layouts.app')

@section('page-title','Mail/SMS Config List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mail/SMS - Configuration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Mail/SMS - Configuration List</li>
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
          <div class="card card-primary card-outline">
				   <div class="card-header">
                       <h3 class="card-title clearfix">E-mail Configuration</h3>
						<div class="card-tools">
						  
						</div>
					</div>
					
						<div class="card-body table-responsive">
        <div class="row">
			<div class="col-6">
                <div style="text-align:center; color:ffffff; background-color:#6aaec3; font-size:1.5rem;">Device Calibration Alert Mail Notification</div>
        @foreach(config('constants.mailsms') as $key =>$option )
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">List of {{$key}} </h3>
						<div class="card-tools">
						   <button  class="add_mailsms btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Mail Config" option_name="{{$option}}" role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</button>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover mailsmssObjects-table" role="{{$option}}" style="width:100%">
								<thead>
									<tr>
										<th>Fieldsname</th>
		                                <th>value</th>
		                                <th>Plant ID</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div><!--/. card-body -->
				</div><!--/. card -->
        @endforeach
			</div>
            
            
            <div class="col-6">
        <div style="text-align:center; color:ffffff; background-color:#6aaec3; font-size:1.5rem;">Device Calibration Alert Escalation  Mail Notification</div>
        @foreach(config('constants.expirealertmail') as $key =>$option )
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">List of {{$key}} </h3>
						<div class="card-tools">
						   <button  class="add_mailsmss btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Mail Config" option_name="{{$option}}" role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</button>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover expirealertmailsObjects-table" role="{{$option}}" style="width:100%">
								<thead>
									<tr>
										<th>Fieldsname</th>
		                                <th>value</th>
		                                <th>Plant ID</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div><!--/. card-body -->
				</div><!--/. card -->
        @endforeach
			</div>
            
            
		</div> <!--/. row -->
	  </div><!--/. container-fluid -->
	  </div><!--/. container-fluid -->
          
          
          
                    <div class="card card-primary card-outline">
				   <div class="card-header">
                       <h3 class="card-title clearfix">SMS Configuration</h3>
						<div class="card-tools">
						  
						</div>
					</div>
					
						<div class="card-body table-responsive">
        <div class="row">
			<div class="col-6">
                <div style="text-align:center; color:ffffff; background-color:#b09bd5; font-size:1.5rem;">Device Calibration Alert SMS Notification</div>
        @foreach(config('constants.alertsms') as $key =>$option )
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">List of {{$key}} </h3>
						<div class="card-tools">
						   <button  class="add_mailsmsss btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New SMS Config" option_name="{{$option}}" role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</button>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover alertsmsObjects-table" role="{{$option}}" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
		                                <th>Number</th>
		                                <th>Plant ID</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div><!--/. card-body -->
				</div><!--/. card -->
        @endforeach
			</div>
            
            
            <div class="col-6">
        <div style="text-align:center; color:ffffff; background-color:#b09bd5; font-size:1.5rem;">Device Calibration Alert Escalation  SMS Notification</div>
        @foreach(config('constants.expirealertsms') as $key =>$option )
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">List of {{$key}} </h3>
						<div class="card-tools">
						   <button  class="add_mailsmssss btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New SMS Config" option_name="{{$option}}" role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</button>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover expirealertsmsObjects-table" role="{{$option}}" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
		                                <th>Number</th>
		                                <th>Plant ID</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div><!--/. card-body -->
				</div><!--/. card -->
        @endforeach
			</div>
            
            
		</div> <!--/. row -->
	  </div><!--/. container-fluid -->
	  </div><!--/. container-fluid -->
          
          
          
	  </div><!--/. container-fluid -->
    </section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <div class="modal fade " id="mailsms_Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form id="option_form" method="post" action="{{route('mailsms.mailsms.store')}}">
          @csrf
          <input type="hidden" id="fieldsname" name="fieldsname"/>
        <div class="modal-header">
          <h4 class="modal-title">Create a <span id="modal-header-namess"></span> Mail</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="option" class="col-md-3 col-sm-6 control-label">Value<span style="color:red">*</span></label>
                <div class="col-md-9 col-sm-6 float-right">
                    <input class="form-control " name="optionvalue" type="email" id="optionvalue" minlength="1" placeholder="Enter Value here..." autofocus required>
                </div>
            </div>
            <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
            <div class="col-md-9 col-sm-6 float-right">
            <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" required>
        	    <option value="" style="display: none;" disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}">
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
            </select>
        
    </div>
    </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <div class="modal fade " id="mailsms_Modal_forUpdate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update a <span id="modal-header-name"></span> Mail</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    <div class="modal fade " id="mailsms_Modals" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form id="option_forms" method="post" action="{{route('mailsms.mailsms.store')}}">
          @csrf
          <input type="hidden" id="fieldsnames" name="fieldsname"/>
        <div class="modal-header">
          <h4 class="modal-title">Create a <span id="modal-header-namess"></span> Mail</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="option" class="col-md-3 col-sm-6 control-label">Value<span style="color:red">*</span></label>
                <div class="col-md-9 col-sm-6 float-right">
                    <input class="form-control " name="optionvalue" type="email" id="optionvalue" minlength="1" placeholder="Enter Value here..." autofocus required>
                </div>
            </div>
            <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
            <div class="col-md-9 col-sm-6 float-right">
            <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" required>
        	    <option value="" style="display: none;" disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}">
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
            </select>
        
    </div>
    </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>


    <div class="modal fade " id="mailsms_Modalsss" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form id="option_formss" method="post" action="{{route('mailsms.mailsms.store')}}">
          @csrf
          <input type="hidden" id="fieldsnamess" name="fieldsname"/>
        <div class="modal-header">
          <h4 class="modal-title">Add a Mobile Number</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="option" class="col-md-3 col-sm-6 control-label">Mobile No<span style="color:red">*</span></label>
                <div class="col-md-9 col-sm-6 float-right">
                    <input class="form-control " name="optionvalue" type="text" id="optionvalue" minlength="1" placeholder="Enter Value here..." autofocus required>
                </div>
            </div>
            <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
            <div class="col-md-9 col-sm-6 float-right">
            <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" required>
        	    <option value="" style="display: none;" disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}">
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
            </select>
        
    </div>
    </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>


<!--Expire SMS Module-->

 <div class="modal fade " id="mailsms_Modalssss" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form id="option_formsss" method="post" action="{{route('mailsms.mailsms.store')}}">
          @csrf
          <input type="hidden" id="fieldsnamesss" name="fieldsname"/>
        <div class="modal-header">
          <h4 class="modal-title">Add a Mobile Number</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="option" class="col-md-3 col-sm-6 control-label">Mobile No<span style="color:red">*</span></label>
                <div class="col-md-9 col-sm-6 float-right">
                    <input class="form-control " name="optionvalue" type="text" id="optionvalue" minlength="1" placeholder="Enter Value here..." autofocus required>
                </div>
            </div>
            <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
            <div class="col-md-9 col-sm-6 float-right">
            <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" required>
        	    <option value="" style="display: none;" disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}">
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
            </select>
        
    </div>
    </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  
@endsection


@push('scripts')
<!-- DataTables -->

<script>
    $(function() {
      array_of_mailsmss=@json(array_values(config('constants.mailsms')));
      selected_index=0;
      $.each($('.add_mailsms'),function(index, button){
        $(button).on('click',function(){
          $("#modal-header-name").html(array_of_mailsmss[index]);
          $("#fieldsname").val(array_of_mailsmss[index]);
          $("#option_form")[0].reset();
          $("#mailsms_Modal").modal('show');
          selected_index=index;
        });
      });
      // $("#option_form").on('submit',function(event){
      //   event.preventDefault();
      //   $.post($(this).attr('action'),function(data){
      //     refreshTable(selected_index);
      //   });
      // });
      $.each($('.mailsmssObjects-table'),function(index, table){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {'url':'{!! route('get.mailsms.data') !!}',
                   'data':function(d){
                   //console.log(d)
                    d.option_name=array_of_mailsmss[index];
                    return d;
                   }},
            columns: [
                    { data: 'fieldsname', name: 'fieldsname' },     
                    { data: 'optionvalue', name: 'optionvalue' },     
                    { data: 'plant_id', name: 'plant_id' },     

        { data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this mailsmss?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                       
                            if(data.status!==false)
                  {
                     refreshTable(index);
                  }
                  else
                      {
        $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:data.message
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
                      }
                    
                    }
                );
            }
        });  
    }
    );
        
       
      array_of_expirealertmails=@json(array_values(config('constants.expirealertmail')));
      selected_index=0;
      $.each($('.add_mailsmss'),function(index, button){
        $(button).on('click',function(){
          $("#modal-header-namess").html(array_of_expirealertmails[index]);
          $("#fieldsnames").val(array_of_expirealertmails[index]);
          $("#option_forms")[0].reset();
          $("#mailsms_Modals").modal('show');
          selected_index=index;
        });
      });
      // $("#option_form").on('submit',function(event){
      //   event.preventDefault();
      //   $.post($(this).attr('action'),function(data){
      //     refreshTable(selected_index);
      //   });
      // });
      $.each($('.expirealertmailsObjects-table'),function(index, table){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {'url':'{!! route('get.expirealertmail.data') !!}',
                   'data':function(d){
                    d.option_name=array_of_expirealertmails[index];
                    return d;
                   }},
            columns: [
                    { data: 'fieldsname', name: 'fieldsname' },     
                    { data: 'optionvalue', name: 'optionvalue' },     
                    { data: 'plant_id', name: 'plant_id' },     

        { data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this expirealertmails?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                       
                            if(data.status!==false)
                  {
                     refreshTable(index);
                  }
                  else
                      {
        $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:data.message
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
                      }
                    
                    }
                );
            }
        });  
    }
    );
        
        
        
      array_of_alertsms=@json(array_values(config('constants.alertsms')));
      selected_index=0;
      $.each($('.add_mailsmsss'),function(index, button){
        $(button).on('click',function(){
          $("#modal-header-namesss").html(array_of_alertsms[index]);
          $("#fieldsnamess").val(array_of_alertsms[index]);
          $("#option_formss")[0].reset();
          $("#mailsms_Modalsss").modal('show');
          selected_index=index;
        });
      });
      // $("#option_form").on('submit',function(event){
      //   event.preventDefault();
      //   $.post($(this).attr('action'),function(data){
      //     refreshTable(selected_index);
      //   });
      // });
      $.each($('.alertsmsObjects-table'),function(index, table){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {'url':'{!! route('get.expirealertmail.data') !!}',
                   'data':function(d){
                    d.option_name=array_of_alertsms[index];
                    return d;
                   }},
            columns: [
                    { data: 'fieldsname', name: 'fieldsname' },     
                    { data: 'optionvalue', name: 'optionvalue' },     
                    { data: 'plant_id', name: 'plant_id' },     

        { data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this expirealertmails?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                       
                            if(data.status!==false)
                  {
                     refreshTable(index);
                  }
                  else
                      {
        $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:data.message
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
                      }
                    
                    }
                );
            }
        });  
    }
    );
        
        
      array_of_expirealertsms=@json(array_values(config('constants.expirealertsms')));
      selected_index=0;
      $.each($('.add_mailsmssss'),function(index, button){
        $(button).on('click',function(){
          $("#modal-header-namessss").html(array_of_expirealertsms[index]);
          $("#fieldsnamesss").val(array_of_expirealertsms[index]);
          $("#option_formsss")[0].reset();
          $("#mailsms_Modalssss").modal('show');
          selected_index=index;
        });
      });
      // $("#option_form").on('submit',function(event){
      //   event.preventDefault();
      //   $.post($(this).attr('action'),function(data){
      //     refreshTable(selected_index);
      //   });
      // });
      $.each($('.expirealertsmsObjects-table'),function(index, table){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {'url':'{!! route('get.expirealertmail.data') !!}',
                   'data':function(d){
                    d.option_name=array_of_expirealertsms[index];
                    return d;
                   }},
            columns: [
                    { data: 'fieldsname', name: 'fieldsname' },     
                    { data: 'optionvalue', name: 'optionvalue' },     
                    { data: 'plant_id', name: 'plant_id' },     

        { data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this expirealertmails?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                       
                            if(data.status!==false)
                  {
                     refreshTable(index);
                  }
                  else
                      {
        $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:data.message
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
                      }
                    
                    }
                );
            }
        });  
    }
    );
        
        
        
        
        
    });
    
    function refreshTable(index)
    {
       $.each($('.mailsmssObjects-table'),function(inner_index, table){
          if(index==inner_index)
            $(table).DataTable().draw(false);
        });
        
        $.each($('.expirealertmailsObjects-table'),function(inner_index, table){
          if(index==inner_index)
            $(table).DataTable().draw(false);
        });
        
        $.each($('.alertsmsObjects-table'),function(inner_index, table){
          if(index==inner_index)
            $(table).DataTable().draw(false);
        });
        
        $.each($('.expirealertsmsObjects-table'),function(inner_index, table){
          if(index==inner_index)
            $(table).DataTable().draw(false);
        });
    }
</script>
@endpush