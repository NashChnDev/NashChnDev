@extends('layouts.app')

@section('page-title','User View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('users.user.index') }}">Users</a></li>
              <li class="breadcrumb-item active">View</li>
			</ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title clearfix">
						   {{ isset($user->name) ? $user->name : 'User' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('users.user.index') }}" class="btn btn-primary btn-sm" title="Show All User">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>
										@can('create_users')
										<a href="{{ route('users.user.create') }}" class="btn btn-success btn-sm" title="Create New User">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										@endcan
										@can('edit_users')
										<a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary btn-sm" title="Edit User">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>
										@endcan
										@can('delete_users')
										<button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Delete User??&quot;)">
											<span class="fa fa-trash" aria-hidden="true"></span>
										</button>
										@endcan
									</div>
								</form>

							</div>
						</h3>
					</div>
					<div class="card-body">
						<div class="card-text">
									<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $user->name }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Email</dt>
            <dd class="col-md-8 col-sm-6">{{ $user->email }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Password</dt>
            <dd class="col-md-8 col-sm-6">{{ $user->password }}</dd>
		</dl>

						</div>
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
