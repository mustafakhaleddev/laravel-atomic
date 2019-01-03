<div class="sidebar-nav slimscrollsidebar">
    <div class="sidebar-head">
        <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                    class="hide-menu">Navigation</span></h3>
    </div>
    <ul class="nav" id="side-menu">
        <li style="padding: 70px 0 0;">
            <a href="{{route('AtomicPanel.dashboard')}}" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                                                                 aria-hidden="true"></i>@lang('atomic::main.Dashboard')</a>
        </li>
        @foreach(\MustafaKhaled\AtomicPanel\AtomicPanel::$atomicModels as $name=>$model)
            @if(!$model::canSee())@continue @endif
            @if(!$model::AtomicDisplayInNavigation())@continue @endif
            <li>
                <a href="{{route('AtomicPanel.AtomicModelIndex',[$name])}}" class="waves-effect"><i class="{{$model::getAtomicClass()}} fa-fw"
                                                               aria-hidden="true"></i>{{$model::label()}}</a>
            </li>
        @endforeach


        @foreach(\MustafaKhaled\AtomicPanel\AtomicPanel::$pages as $page)
            @if(!$page->canSee)@continue @endif
            @if(!$page::AtomicDisplayInNavigation())@continue @endif
            <li>
                <a href="{{route($page::routePath().'.index')}}" class="waves-effect"><i class="{{$page::getAtomicClass()}} fa-fw"
                                                                                                    aria-hidden="true"></i>{{$page::label()}}</a>
            </li>
        @endforeach

    </ul>

</div>
