
<div class="form-group clearfix {{ $errors->has('shiftcode') ? 'has-error' : '' }}">
    <label for="shiftcode" class="col-md-3 col-sm-6 control-label">Shift Code<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="shiftcode" type="text" id="shiftcode" value="{{ old('shiftcode', optional($shift)->shiftcode) }}" minlength="1" placeholder="Enter shiftcode here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15" @if((optional($shift)->shiftcode) != null) readonly @else required @endif>
        {!! $errors->first('shiftcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('shiftname') ? 'has-error' : '' }}">
    <label for="shiftname" class="col-md-3 col-sm-6 control-label">Shift Name<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="shiftname" type="text" id="shiftname" value="{{ old('shiftname', optional($shift)->shiftname) }}" minlength="1" placeholder="Enter shiftname here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30">
        {!! $errors->first('shiftname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('shiftincharge') ? 'has-error' : '' }}">
    <label for="shiftincharge" class="col-md-3 col-sm-6 control-label">Shift In-charge</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="shiftincharge" type="text" id="shiftincharge" value="{{ old('shiftincharge', optional($shift)->shiftincharge) }}" minlength="1" placeholder="Enter shiftincharge here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30">
        {!! $errors->first('shiftincharge', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('shiftstarttime') ? 'has-error' : '' }}">
    <label for="shiftstarttime" class="col-md-3 col-sm-6 control-label">Shift Start Time</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control clockpicker" name="shiftstarttime" type="text" id="shiftstarttime" value="{{old('shiftstarttime', optional($shift)->shiftstarttime) }}" minlength="1" placeholder="Enter shiftstarttime here..." >
        {!! $errors->first('shiftstarttime', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('shiftendtime') ? 'has-error' : '' }}">
    <label for="shiftendtime" class="col-md-3 col-sm-6 control-label">Shift End Time</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control clockpicker" name="shiftendtime" type="text" id="shiftendtime" value="{{ old('shiftendtime', optional($shift)->shiftendtime) }}" minlength="1" placeholder="Enter shiftendtime here...">
        {!! $errors->first('shiftendtime', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('createdby') ? 'has-error' : '' }}">
    <label for="createdby" class="col-md-3 col-sm-6 control-label">Createdby</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="createdby" type="text" id="createdby" value="{{Auth::user()->name, old('createdby', optional($shift)->createdby) }}" minlength="1" placeholder="Enter createdby here..." readonly>
        {!! $errors->first('createdby', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" ng-change="change_plant_company();">
        	    <option value="" style="display: none;" {{ old('plant_id', optional($shift)->plant_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}" {{ old('plant_id', optional($shift)->plant_id) == $plant->plantcode ? 'selected' : '' }}>
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('plant_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
    <label for="company_id" class="col-md-3 col-sm-6 control-label">Company<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">  
        <input class="form-control" ng-model="company_id" name="company_id" type="text" id="company_id" value="{{ old('company_id', optional($shift)->company_id) }}"  readonly>
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
    

<div class="form-group clearfix {{ $errors->has('company_name') ? 'has-error' : '' }}" style="display:none">
    <label for="status" class="col-md-3 col-sm-6 control-label">Company Name</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control" ng-model="company_name" name="company_name" type="text" id="company_name" value="{{ old('company_name', optional($shift)->company_name) }}"  readonly>
        
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

