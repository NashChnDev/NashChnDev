@extends('layouts.app')

@section('page-title','Area Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('area.area.index') }}">Area</a></li>
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
						<form  method="POST" action="{{ route('area.area.update', $area->id) }}" id="edit_area_form" name="edit_department_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($title) ? $title : 'Area' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('area.area.index') }}" class="btn btn-primary btn-sm" title="Show All Area">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('area.area.create') }}" class="btn btn-success btn-sm" title="Create New department">
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

							@if (isset($errors) && count($errors))

							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }} </li>
								@endforeach
							</ul>
							@endif

							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PUT">
							@include ('area.form', [
														'department'=>null,
														'area' => $area,
														'plants'=> $plant
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

    $scope.department_country='{{$department->department_country}}';
    $scope.getStateDetails();
    $scope.department_state=@json($department->state);

    $scope.getCityDetails();
    $scope.department_city=@json($department->city);



@endpush --}}
@endsection
