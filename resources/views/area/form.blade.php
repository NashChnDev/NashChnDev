<!DOCTYPE html>
<html>
<head>
<style> 
.table-bordered{
  font-size: 14px;
}
/* .table{
    margin: auto;
    width: 90%;
    text-align: center;
} */

</style>
</head>
<div class="row" ng-Controller="AreaController" >
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('plantcode') ? 'has-error' : '' }}">
            <label for="company_code" class=" control-label">Plant*</label>
            <select class="form-control" ng-model="plantcode" ng-change="getdepartmentdet()"  id="plantcode" name="plantcode" required>
                <option value="">select plantcode here...</option>
                @foreach ($plants as $key => $plnt)
                    <option value="{{ $plnt->plantcode }}"  {{ old('plantcode', optional($area)->plantcode) == $plnt->plantcode ? 'selected' : '' }}>
                        {{ $plnt->plantcode }}
                    </option>
                @endforeach
            </select>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('departmentcode') ? 'has-error' : '' }}">
            <label for="departmentcode" class=" control-label">Department*</label>
          
            <select ng-model="departmentcode"  class="form-control" id="departmentcode" name="departmentcode" ng-options="dept.deptname for dept in departments track by dept.deptcode" required>
        	    <option  style="display: none;"  disabled selected>select department code here...</option>
        	
        </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('areaname') ? 'has-error' : '' }}">
            <label for="deptname" class=" control-label">Area Name *</label>
            <input class="form-control " autocomplete="off" name="areaname" type="text" id="areaname" value="{{ old('deptname', optional($area)->areaname) }}" minlength="1" placeholder="Enter Area name here..." required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('area_incharge') ? 'has-error' : '' }}">
            <label for="deptincharge" class=" control-label">Area InCharge*</label>
            <input class="form-control " autocomplete="off" name="area_incharge" type="text" id="area_incharge" value="{{ old('area_incharge', optional($area)->area_incharge) }}" minlength="1" placeholder="Enter area Incharge here..." required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status" class=" control-label">Area Status*</label>
            <select class="form-control" id="status" name="status" required>
                <option value="" style="display: none;" {{ old('status', optional($area)->status ?: '') == '' ? 'selected' : '' }} disabled selected>select area status here...</option>
            @foreach (['Active' => 'Active',
        'Inactive' => 'Inactive'] as $key => $text)
                <option value="{{ $key }}" {{ old('status', optional($area)->status) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var AreaController = app.controller('AreaController',function($scope,$http)
    {
        $scope.departments = [];
        $scope.areas = @json($area);
        console.log($scope.areas);
        $scope.departmentcode = '';

        if($scope.areas != undefined && $scope.areas != null){
            $scope.plantcode= $scope.areas.plantcode;
            $scope.departmentcode = $scope.departments;
            $http.get('{{route("area.area.index")}}'+'/getdepartDetails/'+$scope.plantcode).then(function(response){
                if(response.data.status=='success')
                {
                    $scope.departments=response.data.data;
                    let key = Object.keys($scope.departments).find(k=>$scope.departments[k].deptcode===$scope.areas.departmentcode);
                    $scope.departmentcode = $scope.departments[key];
                }               
            });
           

        }else{
            $scope.plantcode= '';
        }
        
        
        $scope.getdepartmentdet=function(){
        $http.get('{{route("area.area.index")}}'+'/getdepartDetails/'+$scope.plantcode).then(function(response){
                if(response.data.status=='success')
                {
                    //console.log(response.data.data);
                    $scope.departments=response.data.data;
                }
               
            });
        };

    });
</script>
@endpush




