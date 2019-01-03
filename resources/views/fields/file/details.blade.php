<div class="form-group">
    <label class="col-md-12">{{$field->name}}</label>
    <div class="col-md-12">
        <a href="{{\Storage::url($field->value)}}" target="_blank"><i class="fa fa-download"></i> {{__("Download File")}}</a>
    </div>
</div>
