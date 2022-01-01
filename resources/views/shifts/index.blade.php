@extends('layouts.app')

@section('page-title','Shifts List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Shifts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Shifts List</li>
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
						<h3 class="card-title clearfix">Shifts</h3>
						<div class="card-tools">
						   <a href="{{ route('shifts.shift.create') }}" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Shift"  role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</a>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover" style="width:100%" id="shifts-table">
								<thead>
									<tr>
												<th>Shift Code</th>
		<th>Shift Name</th>
		<th>Shift In-charge</th>
		<th>Shift Start Time</th>
		<th>Shift End Time</th>
		<th>Createdby</th>
		<th>Plant</th>

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
  <!-- /.content-wrapper -->
@endsection


@push('scripts')
<!-- DataTables -->

<script>
    $(function() {
		$('#shifts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.shift.data') !!}',
            columns: [
										{ data: 'shiftcode', name: 'shiftcode' },     
						{ data: 'shiftname', name: 'shiftname' },     
						{ data: 'shiftincharge', name: 'shiftincharge' },     
						{ data: 'shiftstarttime', name: 'shiftstarttime' },     
						{ data: 'shiftendtime', name: 'shiftendtime' },     
						{ data: 'createdby', name: 'createdby' },     
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
            if (confirm('Are you sure you want to delete this shift?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    
                     if(data.status!==false)
                  {
                    $('#shifts-table').DataTable().draw(false);
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