@extends('layouts.app')

@section('page-title','Shift View')

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
						   {{ isset($title) ? $title : 'Shift' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('shifts.shift.destroy', $shift->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('shifts.shift.index') }}" class="btn btn-primary btn-sm" title="Show All Shift">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('shifts.shift.create') }}" class="btn btn-success btn-sm" title="Create New Shift">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('shifts.shift.edit', $shift->id ) }}" class="btn btn-primary btn-sm" title="Edit Shift">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Shift" onclick="return confirm(&quot;Delete Shift??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Shift Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->shiftcode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Shift Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->shiftname }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Shift In-charge</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->shiftincharge }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Shift Start Time</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->shiftstarttime }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Shift End Time</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->shiftendtime }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Createdby</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->createdby }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company</dt>
            <dd class="col-md-8 col-sm-6">{{ $shift->company_id }}</dd>
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
