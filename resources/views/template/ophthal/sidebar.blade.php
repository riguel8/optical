<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            @if (Auth::check() && Auth::user()->usertype === 'ophthal')
                <li class="{{ request()->is('ophthal/dashboard') ? 'active' : '' }}"><a href="{{ url('ophthal/dashboard') }}"><i class="fe fe-grid"></i><span> Dashboard</span></a></li>
                <li class="{{ request()->is('ophthal/patients') ? 'active' : '' }}"><a href="{{ url('ophthal/patients') }}"><i class="fe fe-users"></i><span> Patients</span></a></li>
                <li class="{{ request()->is('ophthal/appointments') ? 'active' : '' }}"><a href="{{ url('ophthal/appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
            @endif
            </ul>
        </div>
    </div>
</div>
