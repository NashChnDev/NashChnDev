@extends('layouts.app')

@section('page-title','Drop Downs View')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Drop Downs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('drop_downs.drop_downs.index') }}">Drop Downs</a></li>
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
						   {{ isset($title) ? $title : 'Drop Downs' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('drop_downs.drop_downs.destroy', $dropDowns->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('drop_downs.drop_downs.index') }}" class="btn btn-primary btn-sm" title="Show All Drop Downs">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('drop_downs.drop_downs.create') }}" class="btn btn-success btn-sm" title="Create New Drop Downs">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('drop_downs.drop_downs.edit', $dropDowns->id ) }}" class="btn btn-primary btn-sm" title="Edit Drop Downs">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Drop Downs" onclick="return confirm(&quot;Delete Drop Downs??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Fieldsname</dt>
            <dd class="col-md-8 col-sm-6">{{ $dropDowns->fieldsname }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Option value</dt>
            <dd class="col-md-8 col-sm-6">{{ $dropDowns->optionvalue }}</dd>
		</dl>
        <dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Plant Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $dropDowns->plant_id }}</dd>
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
