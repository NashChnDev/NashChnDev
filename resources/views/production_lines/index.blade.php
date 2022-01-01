@extends('layouts.app')

@section('page-title','Production Lines List')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Production Lines</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Production Lines List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	@if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
       </div>
    @endif
    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">Production Lines</h3>
						<div class="card-tools">
						   <a href="{{ route('production_lines.production_lines.create') }}" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Production Lines"  role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</a>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover" style="width:100%" id="productionLinesObjects-table">
								<thead>
									<tr>
												<th>Line Description</th>
		<th>Plant</th>
		<th>Line Incharge</th>
		<th>Line Email ID</th>
		<th>Status</th>

										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div><!--/. card-body -->
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
<!-- DataTables -->

<script>
    $(function() {
		$('#productionLinesObjects-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.productionLines.data') !!}',
            columns: [
										{ data: 'linedescription.optionvalue', name: 'linedescription.optionvalue' },     
						{ data: 'plant.organization', name: 'plant.organization' },     
						{ data: 'lineincharge', name: 'lineincharge' },     
						{ data: 'lineemailid', name: 'lineemailid' },     
						{ data: 'linestatus', name: 'linestatus' },     

				{ data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        }).on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this productionLines?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                        $('#productionLinesObjects-table').DataTable().draw(false);
                    }
                );
            }
        });
    });

</script>
@endpush