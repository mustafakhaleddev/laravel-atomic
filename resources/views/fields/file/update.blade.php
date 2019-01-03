<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <input type="file"
               placeholder="{{$field->name}}"
               name="{{$field->attribute}}"
               class="form-control form-control-line "
               value=""
                {{$field->hasUpdateRule('required')?'required':''}}
        >
        @if($field->value!=null)
            <p class="help-block"><a href="{{\Storage::url($field->value)}}" target="_blank"><i
                            class="fa fa-download"></i> {{__("Download File")}}</a> (<a
                        href="#"
                        data-atomic-delete-url="{{route('AtomicPanel.AtomicUnsetModelColumn',[$AtomicModel::AtomicBaseClassName(),$model->id,$field->attribute])}}"
                        class="atomic-delete-row"><i
                            class="fa fa-remove "></i> {{__("remove File")}}</a>
                )</p>
        @endif
        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
