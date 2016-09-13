<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-2 col-form-label"
           @if(isset($required) and $required) required @endif>{{ $title }} @if(isset($required) and $required)
            * @endif</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="{{ $name }}" @if(isset($value)) value="{{$value}}" @endif>
    </div>
</div>