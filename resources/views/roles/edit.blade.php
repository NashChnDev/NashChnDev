@extends('layouts.app')

@section('page-title','Role Edit')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item"><a href="{{ route('roles.role.index') }}">Roles</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
	
    <section class="content">
		<div class="container-fluid" ng-controller="RolesEditController" >
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<form method="POST" action="{{ route('roles.role.update', $role->id) }}" id="edit_role_form" name="edit_role_form" accept-charset="UTF-8" class="form-horizontal">
							<div class="card-header">
								<h3 class="card-title clearfix">
								   {{ !empty($role->name) ? $role->name : 'Role' }}
								   <div class="btn-group btn-group-sm float-right"  role="group">
										<a href="{{ route('roles.role.index') }}" class="btn btn-primary btn-sm" title="Show All Role">
											<span class="fa fa-th-list" aria-hidden="true"></span>
										</a>

										<a href="{{ route('roles.role.create') }}" class="btn btn-success btn-sm" title="Create New Role">
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
							@include ('roles.form', [
														'role' => $role,
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
@endsection
@push('scripts')
<script type="text/javascript">
	app.controller('RolesEditController',function($scope,$http){
		$scope.permissions=[];
		$scope.mRoleName="{{$role->name}}";
		$scope.mRoleFor="{{$role->guard_name}}";
		$scope.checkall_create;
		$scope.checkall_view;
		$scope.checkall_edit;
		$scope.checkall_delete;
		$scope.checkall_permission;
		$scope.master_permissions=@json(config('constants.crud_permissions'));
		$scope.screen_permissions=@json(config('constants.screen_permissions'));
		// $scope.getPermission=function(){
		// 	$http.get('{{url('get-permissions-by-scope')}}/'+$scope.mRoleFor).then(val=>{
		// 		val=val.data;
		// 		$scope.permissions=val.permissions;
		// 		console.log($scope.permissions);
		// 	});
		// }

		$scope.givenPermission=@json($role->permissions->pluck('id')->toArray());
		$http.get('{{url('get-permissions-by-scope')}}/'+$scope.mRoleFor).then(val=>{
				val=val.data;
				$scope.permissions=val.permissions;
				$scope.master_permissions.forEach(mp=>{
					let cr_per=$scope.permissions.find(ap=>ap.name=='create_'+mp.value);
					let vi_per=$scope.permissions.find(ap=>ap.name=='view_'+mp.value);
					let ed_per=$scope.permissions.find(ap=>ap.name=='edit_'+mp.value);
					let de_per=$scope.permissions.find(ap=>ap.name=='delete_'+mp.value);
					if(cr_per!=null )
					{
						mp.create_permission={'id':cr_per.id,'is_checked':($scope.givenPermission.findIndex(g_per=>g_per==cr_per.id)>-1)};
					}
					if(vi_per!=null)
						mp.view_permission={'id':vi_per.id,'is_checked':($scope.givenPermission.findIndex(g_per=>g_per==vi_per.id)>-1)};
					if(ed_per!=null)
						mp.edit_permission={'id':ed_per.id,'is_checked':($scope.givenPermission.findIndex(g_per=>g_per==ed_per.id)>-1)};
					if(de_per!=null)
						mp.delete_permission={'id':de_per.id,'is_checked':($scope.givenPermission.findIndex(g_per=>g_per==de_per.id)>-1)};
				})

				$scope.screen_permissions.forEach(sp=>{
					let permission=$scope.permissions.find(ap=>ap.name==sp.value);
					if(permission!=null)
						sp.permission={'id':permission.id,'is_checked':($scope.givenPermission.findIndex(g_per=>g_per==permission.id)>-1)};
				})

			});

		$scope.AllowCreate=function(){
			$scope.master_permissions.forEach(mp=>{
				mp.create_permission.is_checked=$scope.checkall_create;
			})
			console.log($scope.master_permissions);
		}
		$scope.AllowView=function(){
			$scope.master_permissions.forEach(mp=>{
				mp.view_permission.is_checked=$scope.checkall_view;
			})
		}
		$scope.AllowEdit=function(){
			$scope.master_permissions.forEach(mp=>{
				mp.edit_permission.is_checked=$scope.checkall_edit;
			})
		}
		$scope.AllowDelete=function(){
			$scope.master_permissions.forEach(mp=>{
				mp.delete_permission.is_checked=$scope.checkall_delete;
			})
		}
		$scope.AllowPermission=function(){
			$scope.screen_permissions.forEach(mp=>{
				mp.permission.is_checked=$scope.checkall_permission;
			})
		}
	})
</script>
@endpush