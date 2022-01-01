@extends('layouts.app')

@section('page-title','Company New')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="companycreate">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Company New</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('companies.company.index') }}">Companies</a></li>
              <li class="breadcrumb-item active">New</li>
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
					<form  method="POST" action="{{ route('companies.company.store') }}" accept-charset="UTF-8" id="create_company_form" name="create_company_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
						<div class="card-header">
							<h3 class="card-title clearfix">
							   Create New Company
							   <div class="float-right">
									<a href="{{ route('companies.company.index') }}" class="btn btn-primary btn-sm" title="Show All Company">
											<span class="fa fa-th-list" aria-hidden="true"></span>
									</a>
													</div>
							</h3>
						</div>
						<div class="card-body">
						<!--	@if ($errors->any())
								<ul class="alert alert-danger">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							@endif-->
						
							{{ csrf_field() }}
							@include ('companies.form', [
														'company' => null,
													  ])
				
							
						</div>
						<div class="card-footer clearfix">
								<input class="btn btn-primary btn-sm pr-4 pl-4" type="submit" value="Add">
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
@push('scripts')

<script>
var companys = new company('companycreate'); 
</script>

@endpush
@endsection
