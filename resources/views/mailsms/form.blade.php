
<div class="form-group clearfix {{ $errors->has('fieldsname') ? 'has-error' : '' }}">
    <label for="fieldsname" class="col-md-3 col-sm-6 control-label">Name</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="fieldsname" type="text" id="fieldsname" value="{{ old('fieldsname', optional($mailsms)->fieldsname) }}" minlength="1" placeholder="Enter fields name here...">
        {!! $errors->first('fieldsname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('optionvalue') ? 'has-error' : '' }}">
    <label for="optionvalue" class="col-md-3 col-sm-6 control-label">value</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="optionvalue" type="text" id="optionvalue" value="{{ old('optionvalue', optional($mailsms)->optionvalue) }}" minlength="1" placeholder="Enter option value here...">
        {!! $errors->first('optionvalue', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
    <div class="col-md-9 col-sm-6 float-right">
<select class="form-control" id="plant_id" name="plant_id">
        	    <option value="" style="display: none;" {{ old('plant_id', optional($mailsms)->plant_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}" {{ old('plant_id', optional($mailsms)->plant_id) == $plant->plantcode ? 'selected' : '' }}>
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
        </select>
        
    </div>
    </div>
