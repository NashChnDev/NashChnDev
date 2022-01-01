@extends('layouts.app')

@section('page-title','Employee Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('employees.employee.index') }}">Employees</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
						<form  method="POST" action="{{ route('newjoiner.employee.update', $employee->id) }}" id="edit_employee_form" name="edit_employee_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($title) ? $title : 'Employee' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('employees.employee.index') }}" class="btn btn-primary btn-sm" title="Show All Employee">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('employees.employee.create') }}" class="btn btn-success btn-sm" title="Create New Employee">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
									</div>
								</h3>
							</div>
						<div class="card-body">
							<!--@if ($errors->any())
								<ul class="alert alert-danger">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							@endif-->


							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PUT">
							@include ('newjoiner.form', [
														'plant'=> $plant,
														'employee' => $employee,
														'dropdowns'=> $dropdowns,
														'departments'=> null
													  ])
								
							</div>
							<div class="card-footer clearfix">
									<input class="btn btn-primary btn-sm pr-4 pl-4" type="submit" value="Update">
							</div>
						</form>
					</div><!--/. card -->
				</div>
			</div> <!--/. row -->
		</div><!--/. container-fluid -->
    </section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

{{-- @push('country-edit-script')

    $scope.company_country='{{$employee->company_country}}';
    $scope.getStateDetails();
    $scope.company_state=@json($employee->state);

    $scope.getCityDetails();
    $scope.company_city=@json($employee->city);

$scope.depetment = @json($departments);
$scope.department_id=@json($employee->department_id);
$scope.deptname=@json($employee->deptname);
$scope.deptdescription=@json($employee->deptdescription);
$scope.plant_id=@json($employee->plant_id);
$scope.company_id=@json($employee->company_id);
$scope.company_name=@json($employee->company_name);


    $scope.get_departmentDeatils =function()
    {
        find_deptinfo=$scope.depetment.find(deptinfo=>deptinfo.deptcode==$scope.department_id)
        console.log(find_deptinfo)
        $scope.deptname=find_deptinfo.deptname;
        $scope.deptdescription=find_deptinfo.deptdescription;
        $scope.plant_id=find_deptinfo.plant_id;
        $scope.company_id=find_deptinfo.company_id;
        $scope.company_name=find_deptinfo.company_name;
    }



@endpush --}}
@push('scripts')
<script>
	// var employee = new employeeClass('employeeedit','@json($employee)'); 
</script>
@endpush
@endsection
