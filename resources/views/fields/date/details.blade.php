<div class="form-group">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <input type="text" readonly placeholder="{{$field->name}}" name="{{$field->attribute}}"
               class="form-control form-control-line "
               value="{{$field->value}}"
        >
    </div>
</div>
