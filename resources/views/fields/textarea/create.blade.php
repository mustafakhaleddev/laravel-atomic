<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <textarea placeholder=
                  "{{$field->name}}" name="{{$field->attribute}}"  class="form-control form-control-line " {{$field->hasCreationRule('required')?'required':''}}>
            {{old($field->attribute)?old($field->attribute):''}}
        </textarea>
        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
