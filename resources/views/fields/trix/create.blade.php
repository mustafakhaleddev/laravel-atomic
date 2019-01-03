<div class="form-group {{$errors->has($field->attribute)?'has-error' : ''}}">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">

        <input id="{{$field->attribute}}" type="hidden"
               {{$field->hasCreationRule('required')?'required':''}}  name="{{$field->attribute}}">
        <trix-editor input="{{$field->attribute}}"></trix-editor>

        @if(isset($field->meta['helpText']))
            <p class="help-block">{{$field->meta['helpText']}}</p>
        @endif
        @if($errors->has($field->attribute))
            <p class="help-block">{{$errors->first($field->attribute)}}</p>
        @endif
    </div>
</div>
<script>
    (function () {

        addEventListener("trix-file-accept", function (event) {
            event.preventDefault();
        })

    })();
</script>