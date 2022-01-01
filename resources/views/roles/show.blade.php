@extends('layouts.app')

@section('page-title','Role View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('roles.role.index') }}">Roles</a></li>
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
						   {{ isset($role->name) ? $role->name : 'Role' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('roles.role.destroy', $role->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('roles.role.index') }}" class="btn btn-primary btn-sm" title="Show All Role">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('roles.role.create') }}" class="btn btn-success btn-sm" title="Create New Role">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('roles.role.edit', $role->id ) }}" class="btn btn-primary btn-sm" title="Edit Role">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Role" onclick="return confirm(&quot;Click Ok to delete Role.?&quot;)">
											<span class="fa fa-trash" aria-hidden="true"></span>
										</button>
									</div>
								</form>

							</div>
						</h3>
					</div>
					<div class="card-body">
						<div class="card-text">
									<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $role->name }}</dd>
		</dl>
		{{-- <dl class="row lp-2">
				            <dt class="col-md-3 col-sm-5">Guard Name</dt>
				            <dd class="col-md-8 col-sm-6">{{ $role->guard_name }}</dd>
						</dl> --}}
						</div>
						<table class="table table-sm table-striped">
							<thead><th>S No</th><th>Permissions</th></thead>
							<tbody>
								@foreach($role->permissions as $key => $permission)
								<tr><td>
									{{$key}}
								</td><td>
									{{$permission->name}}
								</td></tr>
								@endforeach
							</tbody>
						</table>
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
