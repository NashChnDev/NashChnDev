<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customercode') ? 'has-error' : '' }}">
    <label for="customercode" class="col-md-3 col-sm-6 control-label">Customer Code<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customercode" type="text" id="customercode" value="{{ old('customercode', optional($customer)->customercode) }}" minlength="1" placeholder="Enter customer code here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15" @if((optional($customer)->customercode) != null) readonly @else required @endif>
        {!! $errors->first('customercode', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customername') ? 'has-error' : '' }}">
    <label for="customername" class="col-md-3 col-sm-6 control-label">Customer Description<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customername" type="text" id="customername" value="{{ old('customername', optional($customer)->customername) }}" minlength="1" placeholder="Enter customer name here..." oninput="this.value = this.value.replace(/[^a-zA-Z.]/g, ' ');" maxlength="30" required>
        {!! $errors->first('customername', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('Customer_Types') ? 'has-error' : '' }}">
    <label for="Customer_Types" class="col-md-3 col-sm-6 control-label">Customer Types<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="Customer_Types" name="Customer_Types" required>
        	    <option value="" style="display: none;" {{ old('Customer_Types', optional($customer)->Customer_Types ?: '') == '' ? 'selected' : '' }} disabled selected>select customer  types here...</option>
            @foreach ($optionvalues as $key => $optionvalue)
			    <option value="{{ $optionvalue }}" {{ old('Customer_Types', optional($customer)->Customer_Types) == $optionvalue ? 'selected' : '' }}>
			    	{{ $optionvalue }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('Customer_Types', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customeremail') ? 'has-error' : '' }}">
    <label for="customeremail" class="col-md-3 col-sm-6 control-label">Customer Email</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customeremail" type="email" id="customeremail" value="{{ old('customeremail', optional($customer)->customeremail) }}" placeholder="Enter customer email here...">
        {!! $errors->first('customeremail', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customermobile') ? 'has-error' : '' }}">
    <label for="customermobile" class="col-md-3 col-sm-6 control-label">Customer Mobile</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customermobile" type="text" id="customermobile" value="{{ old('customermobile', optional($customer)->customermobile) }}" minlength="1" placeholder="Enter customer mobile here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
        {!! $errors->first('customermobile', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customerphone') ? 'has-error' : '' }}">
    <label for="customerphone" class="col-md-3 col-sm-6 control-label">Customer Phone</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customerphone" type="text" id="customerphone" value="{{ old('customerphone', optional($customer)->customerphone) }}" minlength="1" placeholder="Enter customer phone here..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12">
        {!! $errors->first('customerphone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customeraddress') ? 'has-error' : '' }}">
    <label for="customeraddress" class="col-md-3 col-sm-6 control-label">Customer Address<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <textarea class="form-control" name="customeraddress" cols="50" rows="2" id="customeraddress" minlength="1" placeholder="Enter customer address here..." required>{{ old('customeraddress', optional($customer)->customeraddress) }}</textarea>
        {!! $errors->first('customeraddress', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_country') ? 'has-error' : '' }}">
    <label for="company_country" class="col-md-3 col-sm-6 control-label">Country<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="company_country" name="company_country" ng-model="company_country" ng-change="getStateDetails()" required>
        	    <option value="" style="display: none;" {{ old('company_country', optional($customer)->company_country ?: '') == '' ? 'selected' : '' }} disabled selected>Enter country here...</option>            
            @foreach ($country as $key => $countrys)
			    <option value="{{ $countrys->id }}" {{ old('company_country', optional($customer)->company_country) == $key ? 'selected' : '' }}>
			    	{{ $countrys->country_name  }}
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
        <select class="form-control" id="company_state" name="company_state" ng-model="company_state"  ng-change="getCityDetails()" required ng-options="pass.state_name for pass in States track by pass.id">
        	    <option value="" style="display: none;" {{ old('company_state', optional($customer)->company_state ?: '') == '' ? 'selected' : '' }} disabled selected>Enter state here...</option>
        	
        </select>
        
        {!! $errors->first('company_state', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_city') ? 'has-error' : '' }}">
    <label for="company_city" class="col-md-3 col-sm-6 control-label">City<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="company_city" name="company_city" ng-model="company_city" ng-options="pass.city_name for pass in Cities track by pass.id" required>
        	    <option value="" style="display: none;" {{ old('company_city', optional($customer)->company_city ?: '') == '' ? 'selected' : '' }} disabled selected>Enter city here...</option>
        	
        </select>
        
        {!! $errors->first('company_city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('contact_person') ? 'has-error' : '' }}">
    <label for="contact_person" class="col-md-3 col-sm-6 control-label">Contact Person</label>
    
    
     <div class="input-group col-md-9 col-sm-6 float-right">
      <span class="input-group-addon form-control col-sm-2 col-md-2">
        <select name="sal">
          <option selected="selected" value="Mr.">Mr.</option>
          <option value="Ms.">Ms.</option>
          <option value="Mrs.">Mrs.</option>
        </select>
      </span>
      <input type="text" name="Name" class="form-control" minlength="1" placeholder="Enter contact_person Incharge here..." maxlength="30" oninput="contact_person.value = sal.value +''+ Name.value" value="{{ old('contact_person', optional($customer)->contact_person) }}">
    </div><!-- /input-group -->
    <input class="form-control " name="contact_person" type="hidden" id="contact_person" oninput="this.value = sal.value +''+ Name.value" value="this.value = sal.value +''+ Name.value" >
    {!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}
    
    <!--<div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="contact_person" type="text" id="contact_person" value="{{ old('contact_person', optional($customer)->contact_person) }}" minlength="1" placeholder="Enter contact person here...">
        {!! $errors->first('contact_person', '<p class="help-block">:message</p>') !!}
    </div>-->
    
    
    
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customergstinno') ? 'has-error' : '' }}">
    <label for="customergstinno" class="col-md-3 col-sm-6 control-label">Customer GSTIN no</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="customergstinno" type="text" id="customergstinno" value="{{ old('customergstinno', optional($customer)->customergstinno) }}" minlength="1" placeholder="Enter customer gstinno here..." oninput="this.value = this.value.replace(/[^0-9a-zA-Z.]/g, '');" maxlength="15">
        {!! $errors->first('customergstinno', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customerstatus') ? 'has-error' : '' }}">
    <label for="customerstatus" class="col-md-3 col-sm-6 control-label">Customer Status<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="customerstatus" name="customerstatus" required>
        	    
        	@foreach (['Active' => 'Active',
'Inactive' => 'Inactive'] as $key => $text)
			    <option value="{{ $key }}" {{ old('customerstatus', optional($customer)->customerstatus) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('customerstatus', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('customerremarks') ? 'has-error' : '' }}">
    <label for="customerremarks" class="col-md-3 col-sm-6 control-label">Customer Remarks</label>
    <div class="col-md-9 col-sm-6 float-right">
        <textarea class="form-control" name="customerremarks" cols="50" rows="2" id="customerremarks" minlength="1" placeholder="Enter customer remarks here...">{{ old('customerremarks', optional($customer)->customerremarks) }}</textarea>
        {!! $errors->first('customerremarks', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>

<div class="row">
    
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="plant_id" name="plant_id" ng-model="plant_id" ng-change="change_plant_company();" required>
        	    <option value="" style="display: none;" {{ old('plant_id', optional($customer)->plant_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select plant</option>
        	@foreach ($plants as $key => $plant)
			    <option value="{{ $plant->plantcode }}" {{ old('plant_id', optional($customer)->plant_id) == $plant->plantcode ? 'selected' : '' }}>
			    	{{ $plant->plantcode }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('plant_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
    
<div class="col-md-6">
<div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
    <label for="company_id" class="col-md-3 col-sm-6 control-label">Company<span style="color:red">*</span></label>
    <div class="col-md-9 col-sm-6 float-right">  
        <input class="form-control" ng-model="company_id" name="company_id" type="text" id="company_id" value="{{ old('company_id', optional($customer)->company_id) }}"  readonly>
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
    
        
        <div class="col-md-6" style="display:none">
<div class="form-group clearfix {{ $errors->has('company_name') ? 'has-error' : '' }}">
    <label for="status" class="col-md-3 col-sm-6 control-label">Company Name</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control" ng-model="company_name" name="company_name" type="text" id="company_name" value="{{ old('company_name', optional($customer)->company_name) }}"  readonly>
        
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
</div>


