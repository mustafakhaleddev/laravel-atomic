@extends('atomic::layout')
@if($AtomicModel::AtomicIndexContentView()!=null)
    @include($AtomicModel::AtomicIndexContentView())
@else
@section('content')

    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{$AtomicModel::label()}}</h4></div>
            @if($AtomicModel::canAdd())
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <a href="{{route('AtomicPanel.NewAtomicModel',[$AtomicModelName])}}"
                       class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">{{__('atomic::main.add')}} {{$AtomicModel::singularLabel()}}</a>
                </div>
        @endif
        <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            {{--Widgets Area--}}
            @foreach($AtomicModel::AtomicWidgets() as $widget)
                @if(!$widget->canSee)@continue @endif
                <div class="col-sm-{{$widget->widgetCols}}">
                    {!! $widget->render($AtomicModel) !!}
                </div>
            @endforeach
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">{{$AtomicModel::label()}}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="datatable">
                            <thead>
                            <tr>
                                @foreach($AtomicModel::AtomicFields() as $field)
                                    @if(!$field->showOnIndex || $field->ListingField() || !$field->canSee)@continue @endif
                                    <th>{{$field->name}}</th>
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

@endsection
@section('footer')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                processing: true,
                serverSide: true,
                ajax: '{{route('AtomicPanel.datatable',[$AtomicModelName])}}',
                columns: [

                        @foreach($AtomicModel::AtomicFields() as $field)
                        @if(!$field->showOnIndex || $field->ListingField() || !$field->canSee)@continue @endif

                    {
                        data: '{{$field->getAttribute()}}',
                        name: '{{$field->getAttribute()}}',
                        orderable:{{$field->sortable? 'true' : 'false'}},
                        searchable: {{$field->searchable? 'true' : 'false'}},
                        render: function (value, type, row) {
                            return {!!  $field->renderIndexView($AtomicModel) !!};
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
@endsection

@endif