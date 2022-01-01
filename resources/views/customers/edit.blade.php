@extends('layouts.app')

@section('page-title','Customer Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('customers.customer.index') }}">Customers</a></li>
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
						<form ng-Controller="CountryController" method="POST" action="{{ route('customers.customer.update', $customer->id) }}" id="edit_customer_form" name="edit_customer_form" accept-charset="UTF-8" class="form-horizontal">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($title) ? $title : 'Customer' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('customers.customer.index') }}" class="btn btn-primary btn-sm" title="Show All Customer">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('customers.customer.create') }}" class="btn btn-success btn-sm" title="Create New Customer">
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
							@include ('customers.form', [
														'customer' => $customer,
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

@push('country-edit-script')

    $scope.company_country='{{$customer->company_country}}';
    $scope.getStateDetails();
    $scope.company_state=@json($customer->state);

    $scope.getCityDetails();
    $scope.company_city=@json($customer->city);

    $scope.company_name =@json($customer->company_name);
    $scope.company_id = @json($customer->company_id);


@endpush


@endsection
