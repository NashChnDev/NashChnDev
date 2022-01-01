@extends('layouts.app')

@section('page-title','Company View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Company</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('companies.company.index') }}">Companies</a></li>
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
						   {{ isset($title) ? $title : 'Company' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('companies.company.destroy', $company->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('companies.company.index') }}" class="btn btn-primary btn-sm" title="Show All Company">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('companies.company.create') }}" class="btn btn-success btn-sm" title="Create New Company">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('companies.company.edit', $company->id ) }}" class="btn btn-primary btn-sm" title="Edit Company">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Company" onclick="return confirm(&quot;Delete Company??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Company Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_code }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_name }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Address</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_address }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Country</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_country }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company State</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_state }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company City</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_city }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Email</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_email }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Phone</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_phone }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Mobile</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_mobile }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Website</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_website }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company GstinNo</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_gstinno }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Logo</dt>
            <dd class="col-md-8 col-sm-6 "><img src="{{ asset('storage/'.$company->company_logo) }}" height="100px" width="100px" alt="Brand Logo"  class="img-responsive img-portfolio img-hover"
           style="opacity: 1"></dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company Status</dt>
            <dd class="col-md-8 col-sm-6">{{ $company->company_status }}</dd>
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
