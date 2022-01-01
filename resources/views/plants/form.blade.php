<div class="row">
  <style>
      label{
          font-size: 14px;
          font-weight: normal;
          
      }
  </style>  

    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantcode') ? 'has-error' : '' }}">
    <label for="plantcode" class="col-md-3 col-sm-6 control-label">Plant Code<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="plantcode" type="text" id="plantcode" value="{{ old('plantcode', optional($plants)->plantcode) }}" minlength="1" placeholder="Enter plantcode here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15" @if((optional($plants)->plantcode) != null) readonly @else required @endif>
        {!! $errors->first('plantcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
   

 <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantname') ? 'has-error' : '' }}">
    <label for="plantname" class="col-md-3 col-sm-6 control-label">Plant Name<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="plantname" type="text"  id="plantname" value="{{ old('plantname', optional($plants)->plantname) }}" minlength="1" placeholder="Enter Plant Name here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30" required>
        {!! $errors->first('plantname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>   
    
</div>
<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('location') ? 'has-error' : '' }}">
    <label for="location" class="col-md-3 col-sm-6 control-label">Location</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="location" type="text" id="location" value="{{ old('location', optional($plants)->location) }}" minlength="1" placeholder="Enter location here..."  oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30">
        {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
        <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('organization') ? 'has-error' : '' }}">
    <label for="organization" class="col-md-3 col-sm-6 control-label">Plant GSTIN</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="organization" type="text" id="organization" value="{{ old('organization', optional($plants)->organization) }}" minlength="1" placeholder="Enter GSTIN here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15">
        {!! $errors->first('organization', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>

</div>


<div>


<div class="row">
    
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantaddress') ? 'has-error' : '' }}">
    <label for="plantaddress" class="col-md-3 col-sm-6 control-label">Plant Address<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <textarea class="form-control" name="plantaddress" cols="50" rows="2" id="plantaddress" minlength="1" maxlength="150" placeholder="Enter Plant Address here..." required>{{ old('plantaddress', optional($plants)->plantaddress) }}</textarea>
        {!! $errors->first('plantaddress', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
 <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_country') ? 'has-error' : '' }}">
    <label for="company_country" class="col-md-3 col-sm-6 control-label">Country<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control"  id="company_country" name="company_country" required>
        	    <option value="">select company country here...</option>
        	@foreach ($country as $key => $countrys)
			    <option value="{{ $countrys->id }}" {{ old('company_country', optional($plants)->company_country) == $key ? 'selected' : '' }}>
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
    <label for="company_state" class="col-md-3 col-sm-6 control-label">State<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
         <select  class="form-control" id="company_state" name="company_state"  required>
        	    <option value="" style="display: none;" {{ old('company_state', optional($plants)->company_state ?: '') == '' ? 'selected' : '' }} disabled selected>select company state here...</option>
        	
        </select>
        
        {!! $errors->first('company_state', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_city') ? 'has-error' : '' }}">
    <label for="company_city" class="col-md-3 col-sm-6 control-label">City<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select   class="form-control" id="company_city" name="company_city"  required>
        	    <option value="" style="display: none;" {{ old('company_city', optional($plants)->company_city ?: '') == '' ? 'selected' : '' }} disabled selected>select company city here...</option>
        	
        </select>
        
        {!! $errors->first('company_city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>
    
    
</div>










<div class="row">
  
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantincharge') ? 'has-error' : '' }}">
    <label for="plantincharge" class="col-md-3 col-sm-6 control-label">Plant Incharge<span style="color:red">*</span></label>
    <!--<div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="plantincharge" type="text" id="plantincharge" value="{{ old('plantincharge', optional($plants)->plantincharge) }}" minlength="1" placeholder="Enter Plant Incharge here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30">
        {!! $errors->first('plantincharge', '<p class="help-block">:message</p>') !!}
    </div>-->
    
     <div class="input-group col-md-9 col-sm-6 float-right">
      <span class="input-group-addon form-control col-sm-2 col-md-2">
        <select name="sal"  style="padding: 6px;margin: -12px; border: none;">
          <option selected="selected" value="Mr.">Mr.</option>
          <option value="Ms.">Ms.</option>
          <option value="Mrs.">Mrs.</option>
        </select>
      </span>
      <input type="text" name="Name" class="form-control" minlength="1" placeholder="Enter Plant Incharge here..." maxlength="30" oninput="plantincharge.value = sal.value +''+ Name.value" value="{{ old('plantincharge', optional($plants)->plantincharge) }}" required>
    </div><!-- /input-group -->
    <input class="form-control " name="plantincharge" type="hidden" id="plantincharge" oninput="this.value = sal.value +''+ Name.value" value="this.value = sal.value +''+ Name.value" >
    
    <!-- <input class="form-control " name="plantincharge" type="hidden" id="plantincharge" value="{{ old('plantincharge', optional($plants)->plantincharge) }}" minlength="1" placeholder="Enter Plant Incharge here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30">-->
        {!! $errors->first('plantincharge', '<p class="help-block">:message</p>') !!}
    
</div>
    
    
   
    
    
</div>
 
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantinchargeemail') ? 'has-error' : '' }}">
    <label for="plantinchargeemail" class="col-md-3 col-sm-6 control-label">Plant Incharge Email</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="plantinchargeemail" type="email" id="plantinchargeemail" value="{{ old('plantinchargeemail', optional($plants)->plantinchargeemail) }}" placeholder="Enter Plant Incharge Email here...">
        {!! $errors->first('plantinchargeemail', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plantinchargephone') ? 'has-error' : '' }}">
    <label for="plantinchargephone" class="col-md-3 col-sm-6 control-label">Contact</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="plantinchargephone" type="text" id="plantinchargephone" value="{{ old('plantinchargephone', optional($plants)->plantinchargephone) }}" minlength="1" placeholder="Enter Plant Contact here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
        {!! $errors->first('plantinchargephone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-3 col-sm-6 control-label">Status<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="status" name="status" required>
        	@foreach (['Active' => 'Active',
'Inactive' => 'Inactive'] as $key => $text)
			    <option value="{{ $key }}" {{ old('status', optional($plants)->status) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
    <label for="company_id" class="col-md-3 col-sm-6 control-label">Company ID<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="company_id" name="company_id" required>
        	    <option value="" style="display: none;" {{ old('company_id', optional($plants)->company_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select company</option>
        	@foreach ($companies as $key => $company)
			    <option value="{{ $company->company_code }}" {{ old('company_id', optional($plants)->company_id) == $company->company_code ? 'selected' : '' }}>
			    	{{ $company->company_code }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>


<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_name') ? 'has-error' : '' }}">
    <label for="status" class="col-md-3 col-sm-6 control-label">Company Name<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control"  name="company_name" type="text" id="company_name" value="{{ old('company_name', optional($plants)->company_name) }}"  readonly>
        
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    

</div>