@extends('layouts.app')

@section('page-title','Plants View')

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
						   {{ isset($title) ? $title : 'Plants' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('plants.plants.destroy', $plants->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('plants.plants.index') }}" class="btn btn-primary btn-sm" title="Show All Plants">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('plants.plants.create') }}" class="btn btn-success btn-sm" title="Create New Plants">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('plants.plants.edit', $plants->id ) }}" class="btn btn-primary btn-sm" title="Edit Plants">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Plants" onclick="return confirm(&quot;Delete Plants??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Plant Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantcode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Organization</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->organization }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Location</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->location }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantname }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Address</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantaddress }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Incharge</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantincharge }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Incharge Phone</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantinchargephone }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Incharge Email</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->plantinchargeemail }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->company_id}}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Status</dt>
            <dd class="col-md-8 col-sm-6">{{ $plants->status }}</dd>
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
