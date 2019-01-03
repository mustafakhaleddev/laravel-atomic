<div class="dropdown">

    <div class="profile-pic ropdown-toggle color-white" type="button" id="dropdownMenu1" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="true"><img
                src="https://secure.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?size=512" alt="user-img"
                width="36" class="img-circle"><b class="hidden-xs">{{auth()->user()->name}}</b></div>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{route('AtomicPanel.logout')}}">{{__('atomic::main.logout')}}</a></li>

    </ul>
</div>