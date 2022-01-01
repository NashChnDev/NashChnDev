
<div class="form-group clearfix {{ $errors->has('rangesdescription') ? 'has-error' : '' }}">
    <label for="rangesdescription" class="col-md-3 col-sm-6 control-label">Ranges Description</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="rangesdescription" type="text" id="rangesdescription" value="{{ old('rangesdescription', optional($ranges)->rangesdescription) }}" minlength="1" placeholder="Enter ranges description here...">
        {!! $errors->first('rangesdescription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

