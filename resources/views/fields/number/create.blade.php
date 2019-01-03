<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <input type="number"
               {{isset($field->meta['min'])?'min='.$field->meta['min'] : ''}} {{isset($field->meta['max'])?'max='.$field->meta['max'] : ''}} placeholder="{{$field->name}}"
               name="{{$field->attribute}}"
               class="form-control form-control-line "
               value="{{old($field->attribute)?old($field->attribute):''}}"
                {{$field->hasCreationRule('required')?'required':''}}
        >
        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
