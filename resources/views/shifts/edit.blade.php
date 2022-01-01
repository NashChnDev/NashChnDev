@extends('layouts.app')

@section('page-title','Shift Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Shift</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('shifts.shift.index') }}">Shifts</a></li>
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
						<form ng-controller="shiftcontroller" method="POST" action="{{ route('shifts.shift.update', $shift->id) }}" id="edit_shift_form" name="edit_shift_form" accept-charset="UTF-8" class="form-horizontal">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($title) ? $title : 'Shift' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('shifts.shift.index') }}" class="btn btn-primary btn-sm" title="Show All Shift">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('shifts.shift.create') }}" class="btn btn-success btn-sm" title="Create New Shift">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
									</div>
								</h3>
							</div>
						<div class="card-body">
							@if ($errors->any())
								<ul class="alert alert-danger">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							@endif


							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PUT">
							@include ('shifts.form', [
														'shift' => $shift,
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
@endsection

@push('scripts')

<script>
  var input = $('#shiftstarttime');
   
    input.clockpicker({
    autoclose: true
    });
    
     var input = $('#shiftendtime');
    input.clockpicker({
    autoclose: true
    });

</script>

<script type="text/javascript">
       app.controller('shiftcontroller',function($scope)
     {
    $scope.plants = @json($plants);
    $scope.company_name = '';
    $scope.company_id = '{{$shift->company_id}}';
    $scope.plant_id='{{$shift->plant_id}}';
    $scope.change_plant_company=function()
    { 
        find_company=$scope.plants.find(plantss=>plantss.plantcode==$scope.plant_id)
        $scope.company_id=find_company.company_id;
        $scope.company_name=find_company.company_name;
    }
    
       });
    
</script>

@endpush
