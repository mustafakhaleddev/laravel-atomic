<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <select class="form-control form-control-line"
                {{$field->hasCreationRule('required')?'required':''}} name="{{$field->attribute}}">
            @if($field->nullable)

                <option value="">{{__("Select Value")}}</option>

            @endif
            @foreach($field->model::all() as $model)
                <option value="{{$model->{$field->foreignKey} }}" {{$field->value==$model->{$field->foreignKey}?'selected':''}}>{{$model->{$field->model::modelTitle()} }}</option>
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
