@extends('atomic::layout')
@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{$AtomicModel::label()}}</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{route('AtomicPanel.AtomicModelIndex',[$AtomicModelName])}}" target="_blank"
                   class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">{{__("atomic::main.Back")}}</a>
                <ol class="breadcrumb">
                    <li><a href="#">{{__('atomic::main.add')}} {{$AtomicModel::singularLabel()}}</a></li>
                </ol>
            </div>

            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">{{__("atomic::main.Update")}} {{$AtomicModel::singularLabel()}} </h3>
                    <hr>
                    <form class="form-horizontal form-material"
                          action="{{route('AtomicPanel.AtomicModelUpdate',[$AtomicModelName,$id])}}" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        @foreach($AtomicModel::AtomicFields() as $field)
                            @if(!$field->showOnUpdate || $field->ListingField() || !$field->canSee) @continue @endif
                            {!! $field->renderUpdateView($AtomicModel,$model) !!}
                        @endforeach

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">{{__('atomic::main.Save')}}</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    </div>

@endsection
@section('footer')

@endsection