@extends('layouts.app')

@section('page-title','Plants Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Plants</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('plants.plants.index') }}">Plants</a></li>
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
						<form   method="POST" action="{{ route('plants.plants.update', $plants->id) }}" id="edit_plants_form" name="edit_plants_form" accept-charset="UTF-8" class="form-horizontal">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($title) ? $title : 'Plants' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('plants.plants.index') }}" class="btn btn-primary btn-sm" title="Show All Plants">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('plants.plants.create') }}" class="btn btn-success btn-sm" title="Create New Plants">
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
							@include ('plants.form', [
														'plants' => $plants,
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

{{-- @push('scripts')
<script type="text/javascript">
app.controller('PlantEditcompanyController', function($scope,$http) {
  
    $scope.companies = @json($companies);
    $scope.company_name = @json($plants->company_name);
    $scope.company_id = @json($plants->company_id);
   
    $scope.display_company_name =function()
    {
        find_company=$scope.companies.find(company=>company.company_code==$scope.company_id)
        $scope.company_name=find_company.company_name;
    }
});
</script>
@endpush

@push('country-edit-script')

    $scope.company_country='{{$plants->company_country}}';
    $scope.getStateDetails();
    $scope.company_state=@json($plants->state);

    $scope.getCityDetails();
    $scope.company_city=@json($plants->city);

@endpush --}}
@push('scripts')
<script>
	var plants = new plantsClass('plantedit','@json($plants)','@json($companies)');	
</script>
@endpush

@endsection
