@extends('atomic::layout')
@if($AtomicModel::AtomicDetailsContentView()!=null)
    @include($AtomicModel::AtomicDetailsContentView())
@else
@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{$AtomicModel::label()}}</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{route('AtomicPanel.AtomicModelIndex',[$AtomicModelName])}}"
                   class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">{{__("atomic::main.Back")}}</a>
                <ol class="breadcrumb">
                    <li><a href="#">{{__("atomic::main.View")}} {{$AtomicModel::singularLabel()}}</a></li>
                </ol>
            </div>

            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-sm-12">


                <div class="white-box">
                    <h3 class="box-title">{{$AtomicModel::singularLabel()}} {{__("atomic::main.Details")}}

                        @if($AtomicModel::canEdit())
                            <a href="{{route('AtomicPanel.AtomicModelEdit',[$AtomicModelName,$id])}}"
                               class="btn btn-success pull-right m-l-10 hidden-xs hidden-sm waves-effect waves-light"><i
                                        class="fa fa-pencil"></i></a>
                        @endif

                        @if($AtomicModel::canDelete())

                            <a href="#"
                               data-atomic-delete-url="{{route('AtomicPanel.AtomicModelDelete',[$AtomicModelName,$id])}}"
                               class="atomic-delete-row pull-right m-l-10 hidden-xs hidden-sm waves-effect waves-light btn btn-danger"><i
                                        class="fa fa-trash"></i></a>
                        @endif
                    </h3>


                    <hr>
                    <form class="form-horizontal form-material">

                        @foreach($AtomicModel::AtomicFields() as $field)
                            @if(!$field->showOnDetail || $field->ListingField() || !$field->canSee) @continue @endif
                            {!! $field->renderDetailView($AtomicModel,$model) !!}
                        @endforeach

                    </form>


                </div>
            </div>
            @foreach($AtomicModel::AtomicFields() as $fieldIndex => $field)
                @if(!$field->ListingField() ) @continue @endif
                <div class="col-sm-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <h4 class="page-title">{{$field->name}}</h4></div>
                            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                <a href="{{route('AtomicPanel.NewAtomicModel',[$field->relationName])}}"
                                   class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">{{__('atomic::main.add')}} {{$field->relationModel::singularLabel()}}</a>
                            </div>
                        </div>

                        <div class="row p-t-20">

                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="datatable">
                                        <thead>
                                        <tr>
                                            @foreach($field->relationModel::AtomicFields() as $secondaryField)
                                                @if(!$secondaryField->showOnIndex || $secondaryField->ListingField() || !$secondaryField->canSee)@continue @endif

                                                <th>{{$secondaryField->name}}</th>
                                            @endforeach
                                            <th>@lang('atomic::main.actions')</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        $('#datatable').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ],
                            processing: true,
                            serverSide: true,
                            ajax: '{{route('AtomicPanel.datatable',[$field->relationName])}}?AtomicRelation[]={{$field->relationType}}&AtomicRelation[]={{$AtomicModelName}}&AtomicRelation[]={{$id}}',
                            columns: [

                                    @foreach($field->relationModel::AtomicFields() as $thirdField)
                                    @if(!$thirdField->showOnIndex || $thirdField->ListingField()  || !$secondaryField->canSee)@continue @endif

                                {
                                    data: '{{$thirdField->getAttribute()}}',
                                    name: '{{$thirdField->getAttribute()}}',
                                    orderable:{{$thirdField->sortable? 'true' : 'false'}},
                                    searchable: {{$thirdField->searchable? 'true' : 'false'}},
                                    render: function (value, type, row) {
                                        return {!!  $thirdField->renderIndexView($field->relationModel) !!};
                                    },
                                },

                                    @endforeach
                                {
                                    data: '@lang('atomic::main.actions')',
                                    name: '@lang('atomic::main.actions')',
                                    orderable: false,
                                    searchable: false
                                },
                            ],
                            language: {
                                "sProcessing": "{{__('atomic::datatable.loading')}}",
                                "sLengthMenu": "{{__('atomic::datatable.show')}} _MENU_ {{__('atomic::datatable.entries')}}",
                                "sZeroRecords": "{{__('atomic::datatable.can not found any records')}}",
                                "sInfo": "{{__('atomic::datatable.show')}} _START_ {{__('atomic::datatable.to')}} _END_ {{__('atomic::datatable.from total')}}_TOTAL_ {{__('atomic::datatable.entries')}}",
                                "sInfoEmpty": "{{__('atomic::datatable.show')}} 0 {{__('atomic::datatable.to')}} 0 {{__('atomic::datatable.from total')}} 0 {{__('atomic::datatable.records')}}",
                                "sInfoFiltered": "({{__('filtered from total')}} _MAX_ {{__('atomic::datatable.entry')}})",
                                "sInfoPostFix": "",
                                "sSearch": "{{__('atomic::datatable.search')}}:",
                                "sUrl": "",
                                "oPaginate": {
                                    "sFirst": "{{__('atomic::datatable.first')}}",
                                    "sPrevious": "{{__('atomic::datatable.last')}}",
                                    "sNext": "{{__('atomic::datatable.next')}}",
                                    "sLast": "{{__('atomic::datatable.previous')}}"
                                }
                            }
                        });
                    });
                </script>
            @endforeach
        </div>

    </div>

@endsection
@endif