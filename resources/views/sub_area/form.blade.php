<!DOCTYPE html>
<html>
<head>
<style> 
.table-bordered{
  font-size: 14px;
}
</style>
</head>
<div class="row" ng-Controller="SubareaController" >
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('plantcode') ? 'has-error' : '' }}">
            <label for="company_code" class=" control-label">Plant*</label>
            <select class="form-control" ng-model="plantcode" ng-change="getdepartmentdet()"  id="plantcode" name="plantcode" required>
                <option value="">select plantcode here...</option>
                @foreach ($plants as $key => $plnt)
                    <option value="{{ $plnt->plantcode }}"  {{ old('plantcode', optional($sub_area)->plantcode) == $plnt->plantcode ? 'selected' : '' }}>
                        {{ $plnt->plantcode }}
                    </option>
                @endforeach
            </select>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('department') ? 'has-error' : '' }}">
            <label for="department" class=" control-label">Department*</label>
          
            <select ng-model="departmentcode" ng-change="getareadet()" class="form-control" id="department" name="departmentcode"  ng-options="dept.deptname for dept in departments track by dept.deptcode" >
                <option value=''>Select Department</option>        	  
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('area') ? 'has-error' : '' }}">
            <label for="area" class=" control-label">Area*</label>
          
            <select ng-model="areacode"  class="form-control" id="area" name="areacode" required ng-options="area.areaname for area in areas track by area.areacode" >
        	    <option value=''>Select Area</option>        	  
        	
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('subareaname') ? 'has-error' : '' }}">
            <label for="deptname" class=" control-label">Sub Area Name *</label>
            <input class="form-control " autocomplete="off" name="subareaname" type="text" id="subareaname" value="{{ old('deptname', optional($sub_area)->subareaname) }}" minlength="1" placeholder="Enter sub Area name here..." required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('sub_area_incharge') ? 'has-error' : '' }}">
            <label for="deptincharge" class=" control-label">Sub Area InCharge*</label>
            <input class="form-control " autocomplete="off" name="subareaincharge" type="text" id="subareaincharge" value="{{ old('subareaincharge', optional($sub_area)->subareaincharge) }}" minlength="1" placeholder="Enter Sub area Incharge here..." required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status" class=" control-label">Sub Area Status*</label>
            <select class="form-control" id="status" name="status" required>
                <option value="" style="display: none;" {{ old('status', optional($sub_area)->status ?: '') == '' ? 'selected' : '' }} disabled selected>select area status here...</option>
            @foreach (['Active' => 'Active',
        'Inactive' => 'Inactive'] as $key => $text)
                <option value="{{ $key }}" {{ old('status', optional($sub_area)->status) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
        </div>
    </div>
    @push('scripts')
<script>
    var SubareaController = app.controller('SubareaController',function($scope,$http)
    {
        $scope.departments = [];
        $scope.areas = [];
        $scope.sub_areas = @json($sub_area);
        console.log($scope.sub_areas);
        $scope.departmentcode = '';
        $scope.areacode = '';

        if($scope.sub_areas != undefined && $scope.sub_areas != null){
            console.log($scope.sub_areas);
            $scope.plantcode= $scope.sub_areas.plantcode;
            $scope.departmentcode = $scope.departments;
           
            $http.get('{{route("sub_area.sub_area.index")}}'+'/getdepartDetails/'+$scope.plantcode).then(function(response){
                if(response.data.status=='success')
                {
                    $scope.departments=response.data.data;
                    let key = Object.keys($scope.departments).find(k=>$scope.departments[k].deptcode===$scope.sub_areas.departmentcode);
                    $scope.departmentcode = $scope.departments[key];
                }               
            });
            $http.get('{{route("sub_area.sub_area.index")}}'+'/getareaDetails/'+$scope.plantcode+'/'+$scope.sub_areas.departmentcode).then(function(response){
                if(response.data.status=='success')
                {
                    //console.log(response.data.data);
                    $scope.areas=response.data.data;
                    console.log($scope.areas);
                    let key = Object.keys($scope.areas).find(k=>$scope.areas[k].areacode===$scope.sub_areas.areacode);
                    $scope.areacode = $scope.areas[key];
                }               
            });  

        }else{
            $scope.plantcode= '';
        }
        
        $scope.getdepartmentdet=function(){
            $http.get('{{route("sub_area.sub_area.index")}}'+'/getdepartDetails/'+$scope.plantcode).then(function(response){
                if(response.data.status=='success')
                {
                    //console.log(response.data.data);
                    $scope.departments=response.data.data;
                }
               
            });
        };
        $scope.getareadet=function(){           
            $http.get('{{route("sub_area.sub_area.index")}}'+'/getareaDetails/'+$scope.plantcode+'/'+$scope.departmentcode['deptcode']).then(function(response){
                    if(response.data.status=='success')
                    {
                        //console.log(response.data.data);
                        $scope.areas=response.data.data;
                    }
                
                });
        };
        

    });
</script>
@endpush