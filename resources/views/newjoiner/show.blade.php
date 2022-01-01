@extends('layouts.app')

@section('page-title','Employee View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('employees.employee.index') }}">Employees</a></li>
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
						   {{ isset($title) ? $title : 'Employee' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('employees.employee.index') }}" class="btn btn-primary btn-sm" title="Show All Employee">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('employees.employee.create') }}" class="btn btn-success btn-sm" title="Create New Employee">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('employees.employee.edit', $employee->id ) }}" class="btn btn-primary btn-sm" title="Edit Employee">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Employee" onclick="return confirm(&quot;Delete Employee??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Employee Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empcode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empname }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Department</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->department_id }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Email</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empemail }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Mobile</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empmobile }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Address</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empaddress }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Country</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->country->country_name }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee State</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->state->state_name }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee City</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->city->city_name }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Place</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empplace }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Photo</dt>
            <dd class="col-md-8 col-sm-6">{{ asset('storage/' . $employee->empphoto) }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Status</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empstatus }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Employee Remarks</dt>
            <dd class="col-md-8 col-sm-6">{{ $employee->empremarks }}</dd>
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
