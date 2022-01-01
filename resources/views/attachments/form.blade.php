
<div class="form-group clearfix {{ $errors->has('gaugecode') ? 'has-error' : '' }}">
    <label for="gaugecode" class="col-md-3 col-sm-6 control-label">Gaugecode</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="gaugecode" type="text" id="gaugecode" value="{{ old('gaugecode', optional($attachments)->gaugecode) }}" minlength="1" placeholder="Enter gaugecode here...">
        {!! $errors->first('gaugecode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('attachmenttype') ? 'has-error' : '' }}">
    <label for="attachmenttype" class="col-md-3 col-sm-6 control-label">Attachmenttype</label>
    <div class="col-md-9 col-sm-6 float-right">
        <select class="form-control" id="attachmenttype" name="attachmenttype">
        	    <option value="" style="display: none;" {{ old('attachmenttype', optional($attachments)->attachmenttype ?: '') == '' ? 'selected' : '' }} disabled selected>Select Attachment Type here...</option>
        	@foreach ($attachmenttypes as $key => $attachmenttype)
			    <option value="{{ $key }}" {{ old('attachmenttype', optional($attachments)->attachmenttype) == $key ? 'selected' : '' }}>
			    	{{ $attachmenttype }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('attachmenttype', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('docdate') ? 'has-error' : '' }}">
    <label for="docdate" class="col-md-3 col-sm-6 control-label">Docdate</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="docdate" type="text" id="docdate" value="{{ old('docdate', optional($attachments)->docdate) }}" minlength="1" placeholder="Enter docdate here...">
        {!! $errors->first('docdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group clearfix {{ $errors->has('filename') ? 'has-error' : '' }}">
    <label for="filename" class="col-md-3 col-sm-6 control-label">Filename</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="filename" type="text" id="filename" value="{{ old('filename', optional($attachments)->filename) }}" minlength="1" placeholder="Enter filename here...">
        {!! $errors->first('filename', '<p class="help-block">:message</p>') !!}
    </div>
</div>

