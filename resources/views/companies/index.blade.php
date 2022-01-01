@extends('layouts.app')

@section('page-title','Companies List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Companies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Companies List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<!--@if(Session::has('success_message'))
      
      <div id="alert_success"></div>
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
						<h3 class="card-title clearfix">Companies</h3>
						<div class="card-tools">
						   <a href="{{ route('companies.company.create') }}" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Company"  role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</a>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover" style="width:100%" id="companies-table">
								<thead>
									<tr>
        <th>Company Code</th>
		<th>Company Name</th>
		<th>Company Country</th>
		<th>Company State</th>
		<th>Company City</th>
		<th>Company Email</th>
		<th>Company Mobile</th>
		<th>Company Status</th>

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
		$('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.company.data') !!}',
            columns: [
										{ data: 'company_code', name: 'company_code' },     
						{ data: 'company_name', name: 'company_name' },     
						     
						{ data: 'country.country_name', name: 'country.id' },     
						{ data: 'state.state_name', name: 'state.id' },     
						{ data: 'city.city_name', name: 'city.id' },     
						{ data: 'company_email', name: 'company_email' },     
						
						{ data: 'company_mobile', name: 'company_mobile' },     
					
						{ data: 'company_status', name: 'company_status' },     

				{ data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this company?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    
                    if(data.status!==false)
                  {
                    $('#companies-table').DataTable().draw(false);
                  }
                  else
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
                );
            }
        });
    });

</script>


@endpush