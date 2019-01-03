<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">

        @foreach($field->options as $key=>$value)

            <input type="radio" {{$field->hasCreationRule('required')?'required':''}} name="{{$field->attribute}}"
                   {{$field->value==$key?'checked':''}} value="{{$key}}"> {{$value}}<br>

        @endforeach

        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
