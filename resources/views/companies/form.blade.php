<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_code') ? 'has-error' : '' }}">
    <label for="company_code" class="col-md-3 col-sm-6 control-label">Company Code<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_code" type="text" id="company_code" value="{{ old('company_code', optional($company)->company_code) }}" minlength="1" maxlength="15" placeholder="Enter company code here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" @if((optional($company)->company_code) != null) readonly @else required @endif>
        {!! $errors->first('company_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_name') ? 'has-error' : '' }}">
    <label for="company_name" class="col-md-3 col-sm-6 control-label">Company Name<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_name" type="text" id="company_name" value="{{ old('company_name', optional($company)->company_name) }}" minlength="1" maxlength="30" placeholder="Enter company name here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" required>
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_address') ? 'has-error' : '' }}">
    <label for="company_address" class="col-md-3 col-sm-6 control-label">Company Address<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <textarea class="form-control" name="company_address" cols="50" required rows="2" maxlength="150" id="company_address" minlength="1" placeholder="Enter company address here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.], '');" required>{{ old('company_address', optional($company)->company_address) }}</textarea>
        {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
 <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_country') ? 'has-error' : '' }}">
    <label for="company_country" class="col-md-3 col-sm-6 control-label">Company Country<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control"  id="company_country" name="company_country" required>
        	     <option value="">select company country here...</option>
        	@foreach ($country as $key => $countrys)
			    <option value="{{ $countrys->id }}">
			    	{{ $countrys->country_name }}
			    </option>
            @endforeach
            
        </select>

        {!! $errors->first('company_country', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_state') ? 'has-error' : '' }}">
    <label for="company_state" class="col-md-3 col-sm-6 control-label">Company State<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
         <select class="form-control" id="company_state" name="company_state" required>
                <option value="" style="display: none;" {{ old('company_state', optional($company)->company_state ?: '') == '' ? 'selected' : '' }} disabled selected>select company state here...</option>
                
                {{-- @if(!empty($states))
            @foreach ($states as $key => $state)
			    <option value="{{ $state->id }}" >
			    	{{ $state->state_name }}
			    </option>
            @endforeach
            @endif
             --}}
        </select>
        
        {!! $errors->first('company_state', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_city') ? 'has-error' : '' }}">
    <label for="company_city" class="col-md-3 col-sm-6 control-label">Company City<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select   class="form-control" id="company_city" name="company_city" required>
        	    <option value="" style="display: none;" {{ old('company_city', optional($company)->company_city ?: '') == '' ? 'selected' : '' }} disabled selected>select company city here...</option>
        </select>
        
        {!! $errors->first('company_city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>
   

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_email') ? 'has-error' : '' }}">
    <label for="company_email" class="col-md-3 col-sm-6 control-label">Company Email</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_email" type="email" id="company_email" value="{{ old('company_email', optional($company)->company_email) }}" placeholder="Enter company email here..." >
        {!! $errors->first('company_email', '<p class="label label-danger">:message</p>') !!}
    </div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_phone') ? 'has-error' : '' }}">
    <label for="company_phone" class="col-md-3 col-sm-6 control-label">Company Phone</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_phone" type="text" id="company_phone" value="{{ old('company_phone', optional($company)->company_phone) }}" minlength="1" placeholder="Enter company phone here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
        {!! $errors->first('company_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_mobile') ? 'has-error' : '' }}">
    <label for="company_mobile" class="col-md-3 col-sm-6 control-label">Company Mobile</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_mobile" type="text" id="company_mobile" value="{{ old('company_mobile', optional($company)->company_mobile) }}" minlength="1" placeholder="Enter company mobile here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
        {!! $errors->first('company_mobile', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_website') ? 'has-error' : '' }}">
    <label for="company_website" class="col-md-3 col-sm-6 control-label">Company Website</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_website" type="text" id="company_website" value="{{ old('company_website', optional($company)->company_website) }}" minlength="1" placeholder="Enter company website here...">
        {!! $errors->first('company_website', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">

    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_logo') ? 'has-error' : '' }}">
    <label for="company_logo" class="col-md-3 col-sm-6 control-label">Company Logo</label>
    <div class="col-md-9 col-sm-6 float-right">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="company_logo" id="company_logo" class="hidden" accept="image/png, image/jpeg">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($company->company_logo) && !empty($company->company_logo))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_company_logo" class="custom-delete-file" value="1" {{ old('custom_delete_company_logo', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $company->company_logo }}
                </span>
            </div>
        @endif
        {!! $errors->first('company_logo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_status') ? 'has-error' : '' }}">
    <label for="company_status" class="col-md-3 col-sm-6 control-label">Company Status<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="company_status" name="company_status" required>
        	   
        	@foreach (['Active' => 'Active',
'Inactive' => 'Inactive'] as $key => $text)
			    <option value="{{ $key }}" {{ old('company_status', optional($company)->company_status) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('company_status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
</div>

<div class="row" style="display:none">
    
        <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_gstinno') ? 'has-error' : '' }}">
    <label for="company_gstinno" class="col-md-3 col-sm-6 control-label">Company GstinNo</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="company_gstinno" type="text" id="company_gstinno" value="{{ old('company_gstinno', optional($company)->company_gstinno) }}" minlength="1" placeholder="Enter company gstinno here...">
        {!! $errors->first('company_gstinno', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
</div>


