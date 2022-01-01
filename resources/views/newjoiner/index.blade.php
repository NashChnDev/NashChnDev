@extends('layouts.app')

@section('page-title','Employees List')

@section('content')
<style>
  body{
      font-family: Sans-Serif !important;
  }
  label{
      font-weight: 550 !important;
      font-size: 16px;
      color:rgb(1, 1, 90);
      font-family: Sans-Serif !important;
  }
  input,select{
      border-radius:1px !important; 
      
  }
  .card-header{
      background-color: #6b93b5 !important;
  }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Employee Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Employees List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!--	@if(Session::has('success_message'))
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
						<h3 class="card-title clearfix">Employees</h3>
						<div class="card-tools">
						   <a href="{{ route('newjoiner.employee.create') }}" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Employee"  role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</a>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover" style="width:100%;" id="employees-table">
								<thead>
									<tr>												
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Area</th>
                    <th>Functions</th>
                    <th>Status</th>
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
  <!-- /.content-wrapper -->
@endsection


@push('scripts')
<!-- DataTables -->

<script>
  $(document).ready(function(){
    $('body').on('click','.mailcopylink',function(){      
      var tempid  = $(this).attr('id');
     var emailid = $(this).data('email'); 
      //console.log(emailid);
      if(emailid != '' && emailid != undefined)
      {
        $.ajax({
          type:'GET',
          url:"newjoiner/getmaillink/"+tempid,
          dataType:'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                           
          success:function(res){
            //console.log(res);
            if(res.success == 'success'){
              var maillink = '<div class="card"><div class="card-body">http://localhost:8080/NASH_HRMS/public/enrollform/'+res.id+'</div></div>';
              $("#maillink").find('.modal-body').html(maillink);
              $("#maillink").modal('show');              
            }else{
              var maillink = 'Maybe Information Detail Wrong';
              $("#maillink").find('.modal-body').html(maillink);
              $("#maillink").modal('show');       
            }   
            
          }
        });      
      }
      
    });
  });
    $(function() {
		$('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.newemployee.data') !!}',
          
            columns: [
						{ data: 'name', name: 'name' },     
						{ data: 'email_id', name: 'email_id' },     
						{ data: 'mobile', name: 'mobile' },     
						
						{ data: 'department', name: 'department' },     
						    
						{ data: 'designation', name: 'designation.id' },     
						{ data: 'area', name: 'area' },     
						{ data: 'functions', name: 'functions' },     
					    
						{ data: 'status', name: 'status' },     
					 

				{ data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    
                    if(data.status!==false)
                  {
                    $('#employees-table').DataTable().draw(false);
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
    });

</script>
@endpush