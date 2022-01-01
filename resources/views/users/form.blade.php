
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #7337a1;
        border:#7337a1;
    }
</style>
<div ng-Controller="UserController">
<div class="form-group clearfix {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-3 col-sm-6 control-label">User Name</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-3 col-sm-6 control-label">User Code</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" placeholder="Enter User Code">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-3 col-sm-6 control-label">Password</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control" name="password" type="password" id="password" placeholder="Enter password here...">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group clearfix {{ $errors->has('role_id') ? 'has-error' : '' }}">
    <label for="role_id" class="col-md-3 col-sm-6 control-label">User Roles</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" name="role_id" id="role_id">
            <option value="" selected disabled style="display: none">Select a Role</option>
            @foreach($roles as $key=>$role)
                <option value="{{$role->id}}" {{ old('role_id', optional(optional(optional($user)->roles)->first())->id) == $role->id ? 'selected' : '' }}>
                    {{$role->name}}
                </option>
            @endforeach
        </select>
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group clearfix">
    <label for="role_id" class="col-md-3 col-sm-6 control-label">Plant</label>
    <div class="col-md-9 col-sm-6 float-right">
            <select class="form-control"  name="plant_id" >
                <option value="">Select Plant</option>
                @foreach($companies as $key=>$company)  
                    @foreach($company->plants as $key => $plant)
                  
                    <option value="{{$plant->id}}" {{ old('plant_id', optional($user)->plant_id) == $plant->id ? 'selected' : '' }}>
                        {{$plant->plantcode}}
                    </option>
                    @endforeach
                @endforeach
            </select>
    </div>
</div>

@if(auth()->user()->name == 'Admin')
    <div class="form-group clearfix">
        <label for="role_id" class="col-md-3 col-sm-6 control-label">User Plant Permission </label>
        <div class="col-md-9 col-sm-6 float-right">
                <select class="form-control js-example-basic-multiple" ng-change="getdepartmentdet()" ng-model="plantcods" id="user_plants" name="user_plants[]" multiple="multiple" required>
                    {{-- <select class="form-control js-example-basic-multiple"  id="user_plants" name="user_plants[]" multiple="multiple"> --}}
                    
                    @foreach($companies as $key=>$company)  
                        @foreach($company->plants as $key => $plant)
                        <option value="{{$plant->plantcode}}">
                            {{$plant->plantcode}}  ****   {{ $company->company_name }}    
                        </option>
                        @endforeach
                    @endforeach
                </select>
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('user_departs') ? 'has-error' : '' }}">
        <label for="user_departs" class="col-md-3 col-sm-6 control-label">User Department Permission</label>
        
        <div class="col-md-9 col-sm-6 float-right">
            <select ng-model="departmentcode" multiple="multiple" ng-change="getareadet()" class="form-control js-example-basic-multiple" id="user_departs" name="user_departs[]" ng-options=" dept as dept.deptcode + ' - ' + dept.deptname for dept in departments track by dept.deptcode" >
                <option  style="display: none;"  disabled selected>select department code here...</option>        	
            </select>
        </div>
    </div>
    <div class="form-group clearfix {{ $errors->has('user_areas') ? 'has-error' : '' }}">
        <label for="user_areas" class="col-md-3 col-sm-6 control-label">User Area Permission </label>
    
        <div class="col-md-9 col-sm-6 float-right">
            <select ng-model="area" multiple="multiple"  class="form-control js-example-basic-multiple" id="area" name="user_areas[]" ng-options="area as area.areacode + ' - ' + area.areaname for area in areas track by area.areacode" >
                
                <option  style="display: none;"  disabled selected>select department code here...</option>
            </select>
        </div>
    </div>
   
@endif
</div>
@push('scripts')
  <script>
      $(document).ready(function() {
            $('.js-example-basic-multiple').select2();     
            //$("#user_plants").val(['5100']).trigger('change');   
            var userdata = @json($user);
            //console.log(userdata);    
           // $("#user_plants").val([userdata['user_plants']]).trigger('change');   
            //$("#user_departs").val([userdata['user_departs']]).trigger('change');   
           
  
      });
    var UserController = app.controller('UserController',function($scope,$http)
    {
        $scope.plantcods = [];
        $scope.departmentcode = [];
        $scope.departments = [];
        $scope.areas = [];
        $scope.area=[];
        $scope.approve_area =[];
        $scope.users = @json($user);
      
        if($scope.users != null)
        {
           console.log($scope.users.user_plants);
           console.log($scope.users.user_departs);
            if($scope.users.user_plants != '' && $scope.users.user_plants != null){
                
                $scope.plantcode = $scope.users['user_plants'].split(',');
                $http.post('{{route("users.user.getdeprt")}}',$scope.plantcode).then(function(response){
                    if(response.data.status=='success')
                    {                       
                        $scope.departments=response.data.data;
                       
                        var selected_dept = [];
                        if($scope.departments.length > 0 && $scope.users['user_departs'] != null && $scope.users['user_departs'] != ''){
                            var user_dept_array = $scope.users['user_departs'].split(',');
                            $.each($scope.departments,function(key,val){
                                                            if(user_dept_array.includes(val.deptcode)){
                                    selected_dept.push(val);
                                }
                            });
                        }
                        $scope.departmentcode = selected_dept;
                    }
                });
            }
            if($scope.users.user_departs != '' && $scope.users.user_departs != null){
                var deploop = [];
                deploop = $scope.users['user_departs'].split(',');
                if(deploop.length > 0){
                    $http.post('{{route("users.user.getarea")}}',deploop).then(function(response){
                        if(response.data.status=='success')
                        {
                        $scope.areas=response.data.data;
                        //console.log($scope.areas);
                        var selected_area = []; var selected_approve = [];
                        if($scope.areas.length > 0 && $scope.users['user_areas'] != null && $scope.users['user_areas'] != ''){
                            var user_area_array = $scope.users['user_areas'].split(',');
                            $.each($scope.areas,function(key,val){
                                                            if(user_area_array.includes(val.areacode)){
                                                                selected_area.push(val);
                                }
                            });
                        }
                        // if($scope.areas.length > 0 && $scope.users['user_approve'] != null && $scope.users['user_approve'] != ''){
                        //     var user_approve_array = $scope.users['user_approve'].split(',');
                        //     $.each($scope.areas,function(key,val){
                        //                                     if(user_approve_array.includes(val.areacode)){
                        //                                         selected_approve.push(val);
                        //         }
                        //     });
                        // }
                        $scope.area = selected_area;
                        // $scope.approve_area = selected_approve;
                        
                        }            
                    });    
                }
                
            }
            
        }
    


        
        $scope.getdepartmentdet = function(){
            
            console.log('d'+$scope.plantcode);
            if($scope.plantcods.length > 0){

                  $http.post('{{route("users.user.getdeprt")}}',$scope.plantcode).then(function(response){
                    if(response.data.status=='success')
                    {
                        //console.log(response.data.data);
                        $scope.departments=response.data.data;
                        //$scope.departmentcode = $scope.users.user_departs; 
                    }
                
                });
            }else{
                $scope.departments = [];
                $scope.areas = [];
            }
      
        };
        
        $scope.getareadet = function(){  
            var deptloop = [];
            //console.log(deptloop);
            //console.log();
            if($scope.departmentcode !=undefined && $scope.departmentcode.length > 0){
                for(var index1 of $scope.departmentcode){
                    deptloop.push(index1.deptcode);
                }
            }
            if(deptloop.length > 0){
                $http.post('{{route("users.user.getarea")}}',deptloop).then(function(response){
                    if(response.data.status=='success')
                    {
                      $scope.areas=response.data.data;
                    }            
                });    
            }                 
        };

     
       
    });
    
  </script>
@endpush