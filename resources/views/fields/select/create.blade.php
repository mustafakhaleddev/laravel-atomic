<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <select class="form-control form-control-line"
                {{$field->hasCreationRule('required')?'required':''}} name="{{$field->attribute}}">

            @foreach($field->options as $key=>$value)
                <option value="{{$key}}" {{$field->value==$key?'selected':''}}>{{$value}}</option>
            @endforeach
        </select>

        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
