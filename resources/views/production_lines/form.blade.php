
<div class="form-group clearfix {{ $errors->has('linedescription') ? 'has-error' : '' }}">
    <label for="linedescription" class="col-md-3 col-sm-6 control-label">Line Description</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="linedescription" name="linedescription">
        	    <option value="" style="display: none;" {{ old('linedescription', optional($productionLines)->linedescription ?: '') == '' ? 'selected' : '' }} disabled selected>Select line description here...</option>
        	@foreach ($linedescriptions as $key => $linedescription)
			    <option value="{{ $key }}" {{ old('linedescription', optional($productionLines)->linedescription) == $key ? 'selected' : '' }}>
			    	{{ $linedescription }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('linedescription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="plant_id" name="plant_id">
        	    <option value="" style="display: none;" {{ old('plant_id', optional($productionLines)->plant_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $key }}" {{ old('plant_id', optional($productionLines)->plant_id) == $key ? 'selected' : '' }}>
			    	{{ $plant }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('plant_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('lineincharge') ? 'has-error' : '' }}">
    <label for="lineincharge" class="col-md-3 col-sm-6 control-label">Line Incharge</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="lineincharge" type="text" id="lineincharge" value="{{ old('lineincharge', optional($productionLines)->lineincharge) }}" minlength="1" placeholder="Enter lineincharge here...">
        {!! $errors->first('lineincharge', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('lineemailid') ? 'has-error' : '' }}">
    <label for="lineemailid" class="col-md-3 col-sm-6 control-label">Line Email ID</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="lineemailid" type="email" id="lineemailid" value="{{ old('lineemailid', optional($productionLines)->lineemailid) }}" placeholder="Enter lineemailid here...">
        {!! $errors->first('lineemailid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('linestatus') ? 'has-error' : '' }}">
    <label for="linestatus" class="col-md-3 col-sm-6 control-label">Status</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="linestatus" name="linestatus">
        	    <option value="" style="display: none;" {{ old('linestatus', optional($productionLines)->linestatus ?: '') == '' ? 'selected' : '' }} disabled selected>select linestatus here...</option>
        	@foreach (['Active' => 'Active',
'Inactive' => 'Inactive'] as $key => $text)
			    <option value="{{ $key }}" {{ old('linestatus', optional($productionLines)->linestatus) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('linestatus', '<p class="help-block">:message</p>') !!}
    </div>
</div>

