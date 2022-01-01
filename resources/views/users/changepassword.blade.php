@extends('layouts.app')

@section('page-title','Change Password')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	@if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
       </div>
    @endif
    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">Change a Password</h3>
					</div>
		          <form action="{{route('users.user.changemypassword',auth()->Id())}}" method="post">
              @csrf
						<div class="card-body">
		@if ($errors->any())
                <ul class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif
                <div class="form-group clearfix {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-3 col-sm-6 control-label">New Password</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control" name="password" type="password" id="password" placeholder="Enter New password here...">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
              
						</div><!--/. card-body -->
            <div class="card-footer">
              <input class="btn btn-primary btn-sm pr-4 pl-4" type="submit" value="Update">
            </div>
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
		$('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.user.data') !!}',
            columns: [
										{ data: 'name', name: 'name' },     
						{ data: 'email', name: 'email' },     
						{ data: 'plant.plantname', name: 'plant.plantname' },     

				{ data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                        $('#users-table').DataTable().draw(false);
                    }
                );
            }
        });
    });

</script>
@endpush