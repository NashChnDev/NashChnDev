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
            <h1 class="m-0 text-dark">Sub Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('sub_area.sub_area.index') }}">Sub Area</a></li>
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
						   {{ isset($title) ? $title : 'Sub Area' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('sub_area.sub_area.destroy', $sub_area->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('sub_area.sub_area.index') }}" class="btn btn-primary btn-sm" title="Show All Company">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>
										@can('create_sub_area')
										<a href="{{ route('sub_area.sub_area.create') }}" class="btn btn-success btn-sm" title="Create New Company">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										@endcan
										@can('edit_sub_area')
										<a href="{{ route('sub_area.sub_area.edit', $sub_area->id ) }}" class="btn btn-primary btn-sm" title="Edit Company">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>
										@endcan
										@can('delete_sub_area')
										<button type="submit" class="btn btn-danger btn-sm" title="Delete Company" onclick="return confirm(&quot;Delete Company??&quot;)">
											<span class="fa fa-trash" aria-hidden="true"></span>
										</button>
										@endcan
									</div>
								</form>

							</div>
						</h3>
					</div>
					<div class="card-body">
						<div class="card-text">
									<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $sub_area->plantcode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Department Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $sub_area->departmentcode }}</dd>
		</dl>

		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Sub Area Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $sub_area->subareacode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Sub Area Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $sub_area->subareaname}}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Sub Area Status</dt>
            <dd class="col-md-8 col-sm-6">{{ $sub_area->status }}</dd>
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
