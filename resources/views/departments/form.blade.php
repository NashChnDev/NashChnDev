<div class="row">
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('plant_id') ? 'has-error' : '' }}">
            <label for="company_code" class=" control-label">Plant*</label>
            <select class="form-control"  id="plant_id" name="plant_id" required>
                <option value="">select plantcode here...</option>
                @foreach ($plant as $key => $plnt)
                    <option value="{{ $plnt->plantcode }}"  {{ old('plant_id', optional($department)->plant_id) == $plnt->plantcode ? 'selected' : '' }}>
                        {{ $plnt->plantcode }}
                    </option>
                @endforeach
            </select>   
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('deptname') ? 'has-error' : '' }}">
            <label for="deptname" class=" control-label">Department Option</label>
            {{-- <input class="form-control " autocomplete="off" type="text" id="deptname" value="{{ old('deptname', optional($department)->deptname) }}" minlength="1" placeholder="Enter department name here..." required> --}}
            <select class="form-control" id="dept_option">
                <option value="">Select Option</option>
              @if(!empty($dropdowns))
                @foreach($dropdowns as $downs)
                    @if($downs['fieldsname'] == 'Departments')
                    <option value="{{ $downs['optionvalue'] }}">{{ $downs['optionvalue'] }}</option>
                    @endif
                @endforeach
              @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('deptname') ? 'has-error' : '' }}">
            <label for="deptname" class=" control-label">Department Name*</label>
            <input class="form-control " autocomplete="off" name="deptname" type="text" id="deptname" value="{{ old('deptname', optional($department)->deptname) }}" minlength="1" placeholder="Enter department name here..." required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('deptphone') ? 'has-error' : '' }}">
            <label for="deptphone" class=" control-label">Department Contact No</label>
            <input class="form-control " autocomplete="off" name="deptphone" type="number" id="deptphone" value="{{ old('deptphone', optional($department)->deptphone) }}" minlength="1" placeholder="Enter department Contact here..." >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('deptincharge') ? 'has-error' : '' }}">
            <label for="deptincharge" class=" control-label">Department InCharge*</label>
            <input class="form-control "  autocomplete="off" name="deptincharge" type="text" id="deptincharge" value="{{ old('deptcode', optional($department)->deptincharge) }}" minlength="1" placeholder="Enter department Incharge here..." required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group clearfix {{ $errors->has('deptstatus') ? 'has-error' : '' }}">
            <label for="deptstatus" class=" control-label">Department Status*</label>
            <select class="form-control" id="deptstatus" name="deptstatus" required>
                <option value="" style="display: none;" {{ old('deptstatus', optional($department)->deptstatus ?: '') == '' ? 'selected' : '' }} disabled selected>select company status here...</option>
            @foreach (['Active' => 'Active',
        'Inactive' => 'Inactive'] as $key => $text)
                <option value="{{ $key }}" {{ old('deptstatus', optional($department)->deptstatus) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
        </div>
    </div>

    {{-- <div class="col-md-12">
        <div class="form-group clearfix {{ $errors->has('deptdescription') ? 'has-error' : '' }}">
            <label for="deptdescription" class=" control-label">Department Description</label>
            {{-- <input class="form-control " name="deptdescription" type="text" id="deptdescription" value="{{ old('deptdescription', optional($department)->deptdescription) }}" > 
            <textarea  class="form-control " name="deptdescription" type="text" id="deptdescription" value="{{ old('deptdescription', optional($department)->deptdescription) }}"></textarea>
        </div>
    </div> --}}
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change','#dept_option',function(){
            if($(this).val() != ''){
                $("#deptname").val($(this).val());
            }else{
                $("#deptname").val('');
            }            
        });
    });
</script>
@endpush



