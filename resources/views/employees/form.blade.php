
<div class="row"  ng-Controller="NewjoinerController">
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/nashemployee.css') }}" /> --}}
    <style>
        body{
            font-family: Sans-Serif !important;
        }
        label{
            font-weight: 550 !important;
            font-size: 16px;
            color:rgb(1, 1, 90);
            font-family: Sans-Serif !important;
        }
        input,select{
            border-radius:1px !important; 
            
        }
        .card-header{
            background-color: #6b93b5 !important;
        }
        </style>

<div class="col-md-3">
    <div class="form-group  {{ $errors->has('empcode') ? 'has-error' : '' }}">
        <label for="empcode"> Code<span style="color:red">*</span></label>
            <input class="form-control " name="empcode" type="text" id="empcode" value="{{ old('empcode', optional($employee)->empcode) }}" minlength="1" placeholder="Enter empcode here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15" @if(optional($employee)->empcode) != null) readonly @else required @endif>
            {!! $errors->first('empcode', '<p class="help-block">:message</p>') !!}  
    </div>
</div>

<div class="col-md-3">
        <div class="form-group  {{ $errors->has('empname') ? 'has-error' : '' }}">
            <label for="empname" > Name<span style="color:red">*</span></label><br>
            <input type="text" autocomplete="off" name="name" id="empoldvalue" class="form-control" minlength="1" placeholder="Enter Empname here..." maxlength="30"  value="{{ old('name', optional($employee)->name) }}" required>
        </div>         
            {!! $errors->first('empname', '<p class="help-block">:message</p>') !!}   
</div>
<div class="col-md-3">
    <div class="form-group  {{ $errors->has('empemail') ? 'has-error' : '' }}">
        <label for="empemail" > Email</label>    
            <input class="form-control" autocomplete="off" name="email_id" type="email" id="empemail" value="{{ old('empemail', optional($employee)->email_id) }}" placeholder="Enter empemail here...">
            {!! $errors->first('empemail', '<p class="help-block">:message</p>') !!}
    </div>
</div>
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('empmobile') ? 'has-error' : '' }}">
            <label for="empmobile" > Mobile<span style="color:red">*</span></label>
            <input class="form-control" autocomplete="off" name="mobile" type="text" id="empmobile" value="{{ old('empmobile', optional($employee)->mobile) }}" minlength="1" placeholder="Enter empmobile here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div>   

<div class="col-md-3">
    <div class="form-group  {{ $errors->has('empplace') ? 'has-error' : '' }}">
        <label for="empplace" > Plant<span style="color:red">*</span></label>
        <select class="form-control" id="plantcode" name="joininglocation" ng-model="plant"   ng-change="getdepartmentdet()"  required>
                <option value="">Select Plant</option>
            @foreach ($plant as $key => $pt)
                <option value="{{ $pt->plantcode }}" {{ old('joininglocation', optional($employee)->joininglocation) == $pt->plantcode ? 'selected' : '' }}>
                    {{ $pt->plantcode }}
                </option>
            @endforeach
        </select>
            {!! $errors->first('empplace', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="col-md-3">
    <div class="form-group clearfix {{ $errors->has('department') ? 'has-error' : '' }}">
        <label for="department" class=" control-label">Department*</label>
      
        <select ng-model="departmentcode" ng-change="getareadet()" class="form-control" id="department" name="department" required  ng-options="dept.deptname for dept in departments track by dept.deptcode" >
            <option value=''>Select Department</option>        	  
        </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group clearfix {{ $errors->has('area') ? 'has-error' : '' }}">
        <label for="area" class=" control-label">Area*</label>
      
        <select ng-model="area"  class="form-control" id="area" name="area"  ng-options="area.areaname for area in areas track by area.areacode" >
            <option value=''>Select Area</option>        	  
        
    </select>
    </div>
</div>

    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('designation') ? 'has-error' : '' }}">
            <label for="empmobile" > Designation<span style="color:red">*</span></label>
            <select class="form-control" id="designation" name="designation">
                <option value="">Select Designation</option>
                  @foreach($dropdowns as $keys => $vals)
                    @if($vals['fieldsname']=='designation')
                    <option value="{{ $vals['optionvalue'] }}" {{ old('designation', optional($employee)->designation) == $vals['optionvalue'] ? 'selected' : '' }}>{{ $vals['optionvalue'] }}</option>
                    @endif
                  @endforeach
              </select>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('functions') ? 'has-error' : '' }}">
            <label for="empmobile" > Function<span style="color:red">*</span></label>
            <select class="form-control" id="functions" name="functions">
                <option value="">Select Function</option>
                  @foreach($dropdowns as $keys => $vals)
                    @if($vals['fieldsname']=='functions')
                    <option value="{{ $vals['optionvalue'] }}" {{ old('functions', optional($employee)->functions) == $vals['optionvalue'] ? 'selected' : '' }}>{{ $vals['optionvalue'] }}</option>
                    @endif
                  @endforeach
              </select>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('cost_center') ? 'has-error' : '' }}">
            <label for="cost_center" > Cost Center<span style="color:red">*</span></label>
            <select class="form-control" id="cost_center" name="cost_center">
                <option value="">Select Cost Center</option>
                  @foreach($dropdowns as $keys => $vals)
                    @if($vals['fieldsname']=='Costcenter')
                    <option value="{{ $vals['optionvalue'] }}" {{ old('cost_center', optional($employee)->cost_center) == $vals['optionvalue'] ? 'selected' : '' }}>{{ $vals['optionvalue'] }}</option>
                    @endif
                  @endforeach
              </select>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div>   
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('gross_salary') ? 'has-error' : '' }}">
            <label for="gross_salary" > Gross Salary<span style="color:red">*</span></label>
            <input class="form-control " name="gross_salary" type="text" id="gross_salary" value="{{ old('gross_salary', optional($employee)->gross_salary) }}" minlength="1" placeholder="Enter gross salary here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('ctc_salary') ? 'has-error' : '' }}">
            <label for="empmobile" > CTC Salary<span style="color:red">*</span></label>
            <input class="form-control " name="ctc_salary" type="text" id="ctc_salary" value="{{ old('ctc_salary', optional($employee)->ctc_salary) }}" minlength="1" placeholder="Enter CTC salary here..."  required>
                {!! $errors->first('empmobile', '<p class="help-block">:message</p>') !!}
        </div>
    </div> 
    <div class="col-md-3">
        <div class="form-group  {{ $errors->has('bonus') ? 'has-error' : '' }}">
            <label for="empmobile" > Bonus<span style="color:red">*</span></label>
            <input class="form-control " name="bonus" type="text" id="bonus" value="{{ old('bonus', optional($employee)->bonus) }}" minlength="1" placeholder="Enter Bonus here..."   required>
                {!! $errors->first('bonus', '<p class="help-block">:message</p>') !!}
        </div>
    </div> 
    
<div class="col-md-3">
        <div class="form-group  {{ $errors->has('emprole') ? 'has-error' : '' }}">
            <label for="emprole" > Role</label>
            <select class="form-control" id="emprole" name="emprole">
                    
                    @foreach (['company' => 'COMPANY',
        'contract' => 'CONTRACT'] as $key => $text)
                        <option value="{{ $key }}" {{ old('emprole', optional($employee)->emprole) == $key ? 'selected' : '' }}>
                            {{ $text }}
                        </option>
                    @endforeach
                </select>
                
                {!! $errors->first('empstatus', '<p class="help-block">:message</p>') !!}
        </div>    
</div>

<div class="col-md-3">
    <div class="form-group  {{ $errors->has('date_of_joining') ? 'has-error' : '' }}">
        <label for="empremarks" > Date of Joining</label>     
            <input type="date" class="form-control" name="date_of_joining" cols="50" rows="2" id="date_of_joining" minlength="1" placeholder="Enter Emp Date joining here..." value="{{ old('date_of_joining', optional($employee)->date_of_joining) }}">
            {!! $errors->first('empremarks', '<p class="help-block">:message</p>') !!}    
    </div>
</div>
    
<div class="col-md-3" id="contractor" style="display: none">
    <div class="form-group  {{ $errors->has('empcontractorname') ? 'has-error' : '' }}">
    <label for="empcontractorname" > Contractor Name</label>  
        <input type="text" class="form-control" name="empcontractorname" cols="50" rows="2" id="empcontractorname" minlength="1" placeholder="Enter empcontractorname here..." value="{{ old('empcontractorname', optional($employee)->empcontractorname) }}">
        {!! $errors->first('empcontractorname', '<p class="help-block">:message</p>') !!}    
    </div>
</div>
<div class="col-md-3">
    <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" > Status<span style="color:red">*</span></label>   
        <select class="form-control" id="status" name="status" required>
        	   
        	@foreach (['Active' => 'Working ','Inactive' => 'Resigned to be appear'] as $key => $text)
			    <option value="{{ $key }}" {{ old('empstatus', optional($employee)->empstatus) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('empstatus', '<p class="help-block">:message</p>') !!}
</div>
</div>
    

    <div class="col-md-12">
        <div class="form-group  {{ $errors->has('empaddress') ? 'has-error' : '' }}">
            <label for="empaddress" > Address<span style="color:red">*</span></label>  
                <textarea class="form-control" name="empaddress" cols="50" rows="2" id="empaddress" minlength="1" placeholder="Enter empaddress here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.], '');" maxlength="50" required>{{ old('empaddress', optional($employee)->empaddress) }}</textarea>
                {!! $errors->first('empaddress', '<p class="help-block">:message</p>') !!}  
        </div>
    </div>
    {{-- <div class="col-md-3">
        <div class="form-group  {{ $errors->has('empphoto') ? 'has-error' : '' }}">
            <label for="empphoto" > Photo</label>
                <div class="input-group uploaded-file-group">
                    <label class="input-group-btn">
                        <span class="btn btn-default">
                            Browse <input type="file" name="empphoto" id="empphoto" class="hidden" accept="image/png, image/jpeg">
                        </span>
                    </label>
                    <input type="text" class="form-control uploaded-file-name" readonly>
                </div>

                @if (isset($employee->empphoto) && !empty($employee->empphoto))
                    <div class="input-group input-width-input">
                        <span class="input-group-addon">
                            <input type="checkbox" name="custom_delete_empphoto" class="custom-delete-file" value="1" {{ old('custom_delete_empphoto', '0') == '1' ? 'checked' : '' }}> Delete
                        </span>

                        <span class="input-group-addon custom-delete-file-name">
                            {{ $employee->empphoto }}
                        </span>
                    </div>
                @endif
                {!! $errors->first('empphoto', '<p class="help-block">:message</p>') !!}
        </div>
    </div> --}}
</div>
    
    
    

@push('scripts')
<script>
    $(document).ready(function (e) {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        });
    var NewjoinerController = app.controller('NewjoinerController',function($scope,$http)
    {
        $scope.departments = [];
        $scope.employee = @json($employee);
        if($scope.employee != undefined && $scope.employee != null){
            $scope.plant= $scope.employee.joininglocation;
            $scope.departmentcode = $scope.employee.department;
            $http.get('{{route("newjoiner.employee.index")}}'+'/getdepartDetails/'+$scope.plant).then(function(response){
                if(response.data.status=='success')
                {
                    $scope.departments=response.data.data;
                    let key = Object.keys($scope.departments).find(k=>$scope.departments[k].deptcode===$scope.employee.department);
                    $scope.departmentcode = $scope.departments[key];
                }               
            });
            $http.get('{{route("newjoiner.employee.index")}}'+'/getareaDetails/'+$scope.plant+'/'+$scope.departmentcode).then(function(response){
                if(response.data.status=='success')
                {
                    //console.log(response.data.data);
                    $scope.areas=response.data.data;
                    let key = Object.keys($scope.areas).find(k=>$scope.areas[k].areacode===$scope.employee.area);
                    $scope.area = $scope.areas[key];
                }               
            });
        }
        $scope.getdepartmentdet=function(){
            $scope.departments = [];
            $scope.areas =[];
            $http.get('{{route("newjoiner.employee.index")}}'+'/getdepartDetails/'+$scope.plant).then(function(response){
                    if(response.data.status=='success')
                    {
                        //console.log(response.data.data);
                        $scope.departments=response.data.data;
                    }
                
                });
        };
        
        $scope.getareadet=function(){  
            $scope.areas =[];         
            $http.get('{{route("newjoiner.employee.index")}}'+'/getareaDetails/'+$scope.plant+'/'+$scope.departmentcode['deptcode']).then(function(response){
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
