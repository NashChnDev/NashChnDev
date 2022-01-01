
<div class="form-group clearfix {{ $errors->has('fieldsname') ? 'has-error' : '' }}">
    <label for="fieldsname" class="col-md-3 col-sm-6 control-label">Fieldsname</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="fieldsname" type="text" id="fieldsname" value="{{ old('fieldsname', optional($dropDowns)->fieldsname) }}" minlength="1" placeholder="Enter fields name here..." readonly>
        {!! $errors->first('fieldsname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('optionvalue') ? 'has-error' : '' }}">
    <label for="optionvalue" class="col-md-3 col-sm-6 control-label">Option value</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="optionvalue" type="text" id="optionvalue" value="{{ old('optionvalue', optional($dropDowns)->optionvalue) }}" minlength="1" placeholder="Enter option value here...">
        {!! $errors->first('optionvalue', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group clearfix {{ $errors->has('equal_value') ? 'has-error' : '' }}">
    <label for="optionvalue" class="col-md-3 col-sm-6 control-label">Description</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="equal_value" type="text" id="equal_value" value="{{ old('equal_value', optional($dropDowns)->equal_value) }}" minlength="1" placeholder="Enter option value here...">
        {!! $errors->first('equal_value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if((optional($dropDowns)->plant_id) != null)

<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
    <div class="col-md-9 col-sm-6 float-right">
<select  style="width: 100%" multiple="multiple" name="plant_id[]" class="form-control select2" id="plant_id" >
        	 
        	@foreach ($plants as $key => $plant)
			   
     <option value="{{$plant->plantcode}}" {{ (collect(old('plant_id'))->contains($plant->plantcode)) ? 'selected':'' }}{{ (in_array($plant->plantcode,explode(',',$dropDowns->plant_id))) ? 'selected' : ''}}  >{{$plant->plantcode}}</option>

			@endforeach
        </select>
        
    </div>
    </div>

@else

<div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
    <label for="plant_id" class="col-md-3 col-sm-6 control-label">Plant ID</label>
    <div class="col-md-9 col-sm-6 float-right">
<select style="width: 100%" multiple="multiple" name="plant_id[]" class="form-control select2" id="plant_id">
        	@foreach ($plants as $key => $plant)
			    <!--<option value="{{ $plant->plantcode }}" {{ old('plant_id', optional($dropDowns)->plant_id) == $plant->plantcode ? 'selected' : '' }}>
			    	{{ $plant->plantcode }}
			    </option>-->
    <option value="{{$plant->plantcode}}" {{ (collect(old('plant_id'))->contains($plant->plantcode)) ? 'selected':'' }}{{ (in_array($plant->plantcode,explode(',',$dropDowns->plant_id))) ? 'selected' : ''}}  >{{$plant->plantcode}}</option>

			@endforeach
        </select>
        
    </div>
    </div>


@endif


@push('scripts')
<!-- DataTables -->

<script>
    $(function() {

      var plantcode;
$('#plant_id').select2({
                allowClear: true
               
    });
                /*plantcode = @json($plants);
            
                        $("#plant_id").html('');
                        $.each(plantcode,function(i,plantcode){
                          $("#plant_id").append("<option value='"+plantcode.plantcode+"'>"+plantcode.plantcode+"</option>");
                        }); */ 
        
});
</script>
@endpush