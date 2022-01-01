
<div class="form-group clearfix {{ $errors->has('key') ? 'has-error' : '' }}">
    <label for="key" class="col-md-3 col-sm-6 control-label">Key</label>
    <div class="col-md-9 col-sm-6 float-right">
       <!--  <input class="form-control " name="key" type="text" id="key" value="{{ old('key', optional($configurations)->key) }}" minlength="1" placeholder="Enter key here...">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!} -->
        <select id="key" name="key" class="form-control">
            <option selected disabled>Select a Option</option>
            @foreach(config('constants.keyvalue') as $key)
                        <option value="{{$key}}">{{$key}}</option>
              @endforeach
        </select>
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('reqprefix') ? 'has-error' : '' }}">
    <label for="reqprefix" class="col-md-3 col-sm-6 control-label">Reqprefix</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="reqprefix" type="text" id="reqprefix" value="{{ old('reqprefix', optional($configurations)->reqprefix) }}" minlength="1" placeholder="Enter reqprefix here...">
        {!! $errors->first('reqprefix', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('reqsuffix') ? 'has-error' : '' }}">
    <label for="reqsuffix" class="col-md-3 col-sm-6 control-label">Reqsuffix</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="reqsuffix" type="text" id="reqsuffix" value="{{ old('reqsuffix', optional($configurations)->reqsuffix) }}" minlength="1" placeholder="Enter reqsuffix here...">
        {!! $errors->first('reqsuffix', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-3 col-sm-6 control-label">Is Active</label>
    <div class="col-md-9 col-sm-6 float-right">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($configurations)->is_active) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('keyvalue') ? 'has-error' : '' }}">
    <label for="keyvalue" class="col-md-3 col-sm-6 control-label">Keyvalue</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="keyvalue" type="text" id="keyvalue" value="{{ old('keyvalue', optional($configurations)->keyvalue) }}" minlength="1" placeholder="Enter keyvalue here...">
        {!! $errors->first('keyvalue', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('entrydate') ? 'has-error' : '' }}">
    <label for="entrydate" class="col-md-3 col-sm-6 control-label">Entrydate</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="entrydate" type="text" id="entrydate" value="{{ old('entrydate', optional($configurations)->entrydate) }}" minlength="1" placeholder="Enter entrydate here...">
        {!! $errors->first('entrydate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('createdby') ? 'has-error' : '' }}">
    <label for="createdby" class="col-md-3 col-sm-6 control-label">Createdby</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="createdby" type="text" id="createdby" value="{{ old('createdby', optional($configurations)->createdby) }}" minlength="1" placeholder="Enter createdby here...">
        {!! $errors->first('createdby', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
    <label for="company_id" class="col-md-3 col-sm-6 control-label">Company</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="company_id" name="company_id">
        	    <option value="" style="display: none;" {{ old('company_id', optional($configurations)->company_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select company</option>
        	@foreach ($companies as $key => $company)
			    <option value="{{ $key }}" {{ old('company_id', optional($configurations)->company_id) == $key ? 'selected' : '' }}>
			    	{{ $company }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

