<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            @if (Auth::check() && Auth::user()->usertype === 'ophthal')
                <li class="{{ request()->is('ophthal/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('ophthal/dashboard') }}">
                        <iconify-icon icon="ic:outline-dashboard" width="20" height="20"></iconify-icon>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('ophthal/patients') ? 'active' : '' }}">
                    <a href="{{ url('ophthal/patients') }}">
                        <iconify-icon icon="fluent:patient-32-filled" width="20" height="20"></iconify-icon>
                        <span> Patients</span>
                    </a>
                </li>
                <li class="{{ request()->is('ophthal/appointments') ? 'active' : '' }}">
                    <a href="{{ url('ophthal/appointments') }}">
                        <iconify-icon icon="mdi:calendar-outline" width="20" height="20"></iconify-icon>
                        <span> Appointment</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>
