@extends('layouts.app')

@section('page-title','Customer View')

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
						   {{ isset($title) ? $title : 'Customer' }}
						   <div class="float-right">
								<form method="POST" action="{!! route('customers.customer.destroy', $customer->id) !!}" accept-charset="UTF-8">
									<input name="_method" value="DELETE" type="hidden">
									{{ csrf_field() }}
									<div class="btn-group btn-group-sm" role="group">
										<a href="{{ route('customers.customer.index') }}" class="btn btn-primary btn-sm" title="Show All Customer">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('customers.customer.create') }}" class="btn btn-success btn-sm" title="Create New Customer">
											<span class="fa fa-plus" aria-hidden="true"></span>
										</a>
										
										<a href="{{ route('customers.customer.edit', $customer->id ) }}" class="btn btn-primary btn-sm" title="Edit Customer">
											<span class="fas fa-pencil-alt" aria-hidden="true"></span>
										</a>

										<button type="submit" class="btn btn-danger btn-sm" title="Delete Customer" onclick="return confirm(&quot;Delete Customer??&quot;)">
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
            <dt class="col-md-3 col-sm-5">Customer Code</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customercode }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Name</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customername }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Email</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customeremail }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Mobile</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customermobile }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Phone</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customerphone }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Address</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customeraddress }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Country</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->company_country }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">State</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->company_state }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">City</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->company_city }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Contact Person</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->contact_person }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer GSTIN no</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customergstinno }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Status</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customerstatus }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer Remarks</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->customerremarks }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Company</dt>
            <dd class="col-md-8 col-sm-6">{{ optional($customer->Company)->created_at }}</dd>
		</dl>
		<dl class="row lp-2">
            <dt class="col-md-3 col-sm-5">Customer  Types</dt>
            <dd class="col-md-8 col-sm-6">{{ $customer->Customer_Types }}</dd>
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
