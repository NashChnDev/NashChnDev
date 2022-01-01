@extends('layouts.app')

@section('page-title','Configurations View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Configurations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('configurations.configurations.index') }}">Configurations</a></li>
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
						   {{ isset($title) ? $title : 'Configurations' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('configurations.configurations.destroy', $configurations->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('configurations.configurations.index') }}" class="btn btn-primary btn-sm" title="Show All Configurations">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('configurations.configurations.create') }}" class="btn btn-success btn-sm" title="Create New Configurations">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('configurations.configurations.edit', $configurations->id ) }}" class="btn btn-primary btn-sm" title="Edit Configurations">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Configurations" onclick="return confirm(&quot;Delete Configurations??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Key</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->key }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Reqprefix</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->reqprefix }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Reqsuffix</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->reqsuffix }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Is Active</dt>
            <dd class="col-md-8 col-sm-6">{{ ($configurations->is_active) ? 'Yes' : 'No' }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Keyvalue</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->keyvalue }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Entrydate</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->entrydate }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Createdby</dt>
            <dd class="col-md-8 col-sm-6">{{ $configurations->createdby }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company</dt>
            <dd class="col-md-8 col-sm-6">{{ optional($configurations->Company)->created_at }}</dd>
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
