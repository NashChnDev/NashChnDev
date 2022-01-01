@extends('layouts.app')

@section('page-title','Drop Downs List')

@section('content')
<style>
  .active{
    display: block;
  }
  .inactive{
    display:none;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark col-sm-6">Drop Downs</h1>
            <select class="form-control col-sm-6" id="drop_down_select">
              <option value="All">ALL</option>
              @foreach(config('constants.options_from_db') as $key =>$option )
               <option value="{{ $key }}">{{ $key }}</option>
               @endforeach
            </select>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			         <li class="breadcrumb-item active">Drop Downs List</li>
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
			<div class="col-12" id="dropdown_lists">
        @foreach(config('constants.options_from_db') as $key =>$option )
				<div class="card card-primary card-outline active"  id="{{ $key }}">
				   <div class="card-header">
						<h3 class="card-title clearfix">Options For {{$key}} </h3>
						<div class="card-tools">
						   <button  class="add_dropdown btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Drop Downs" option_name="{{$option}}" role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</button>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover dropDownsObjects-table" role="{{$option}}" style="width:100%">
								<thead>
									<tr>
										<th>Fieldsname</th>
		                                <th>Option value</th>
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
    </section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <div class="modal fade " id="dropDown_Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form id="option_form" method="post" action="{{route('drop_downs.drop_downs.store')}}">
          @csrf
          <input type="hidden" id="fieldsname" name="fieldsname"/>
        <div class="modal-header">
          <h4 class="modal-title">Create a <span id="modal-header-name"></span> DropDown</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="option" class="col-md-3 col-sm-6 control-label">Option<span style="color:red">*</span></label>
                <div class="col-md-9 col-sm-6 float-right">
                    <input class="form-control " name="optionvalue" type="text" id="optionvalue" minlength="1" placeholder="Enter Value here..." autofocus required>
                </div>
            </div>
            <div class="form-group clearfix">
              <label for="option" class="col-md-3 col-sm-6 control-label">Description<span style="color:red"></span></label>
              <div class="col-md-9 col-sm-6 float-right">
                <textarea class="form-control" name="equal_value" id="equal_value" placeholder="Enter Value here..."></textarea>
                  
              </div>
          </div>
            <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
            <div class="col-md-9 col-sm-6 float-right">
            <select style="width: 100%" class="form-control select2" id="plant_id" multiple="multiple" name="plant_id[]" ng-model="plant_id" required>
        	    <option selected>Select</option> 
            
        
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
  <div class="modal fade " id="dropDown_Modal_forUpdate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update a <span id="modal-header-name"></span> DropDown</h4>
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
  
@endsection


@push('scripts')
<!-- DataTables -->

<script>
    $(function() {
      array_of_dropdowns=@json(array_values(config('constants.options_from_db')));
      selected_index=0;
      $.each($('.add_dropdown'),function(index, button){
        $(button).on('click',function(){
          $("#modal-header-name").html(array_of_dropdowns[index]);
          $("#fieldsname").val(array_of_dropdowns[index]);
          $("#option_form")[0].reset();
          $("#dropDown_Modal").modal('show');
          selected_index=index;
        });
      });
      // $("#option_form").on('submit',function(event){
      //   event.preventDefault();
      //   $.post($(this).attr('action'),function(data){
      //     refreshTable(selected_index);
      //   });
      // });
      $.each($('.dropDownsObjects-table'),function(index, table){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {'url':'{!! route('get.dropDowns.data') !!}',
                   'data':function(d){
                    d.option_name=array_of_dropdowns[index];
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
            if (confirm('Are you sure you want to delete this dropDowns?')) {
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
        
        
        
      var plantcode;
$('#plant_id').select2({
                allowClear: true
               
    });
                plantcode = @json($plants);
            
                        $("#plant_id").html('');
                        $("#plant_id").html("<option value='All'>All</option>");
                        $.each(plantcode,function(i,plantcode){
                          $("#plant_id").append("<option value='"+plantcode.plantcode+"'>"+plantcode.plantcode+"</option>");
                        });  
        
        
        
    });
    $("body").on('change','#plant_id',function(){
      $('#plant_id').select2({ allowClear: true });
        
      let selectedval = $(this).val();
      plantcode = @json($plants);
      if(selectedval[0] == 'All' && selectedval.length > 0){
        $('#plant_id').select2({ allowClear: true });
        $("#plant_id").html('');         
        $("#plant_id").html("<option value='All'>All</option>");              
                        $.each(plantcode,function(i,plantcode){
                          $("#plant_id").append("<option value='"+plantcode.plantcode+"' selected>"+plantcode.plantcode+"</option>");
                        }); 
      }
    });
    $("body").on('change',"#drop_down_select",function(){
        let select_value = $(this).val();
        //console.log(select_value);
        if(select_value != 'All'){
          $("body").find('.card').removeClass('active').addClass('inactive');
           $("body").find('#'+select_value).removeClass('inactive').addClass('active');
        }else{
          $("body").find('.card').removeClass('inactive').addClass('active');
        }
     

    });
    function refreshTable(index)
    {
       $.each($('.dropDownsObjects-table'),function(inner_index, table){
          if(index==inner_index)
            $(table).DataTable().draw(false);
        });
    }
</script>
@endpush