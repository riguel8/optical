<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            @if (Auth::check() && Auth::user()->usertype === 'optometrist')
                <li class="{{ request()->is('optometrist/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('optometrist/dashboard') }}">
                        <iconify-icon icon="ic:outline-dashboard" width="20" height="20"></iconify-icon>
                        <span> Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('optometrist/patients') ? 'active' : '' }}">
                    <a href="{{ url('optometrist/patients') }}">
                        <iconify-icon icon="fluent:patient-32-filled" width="20" height="20"></iconify-icon>
                        <span> Patients</span>
                    </a>
                </li>
                <li class="{{ request()->is('optometrist/appointments') ? 'active' : '' }}">
                    <a href="{{ url('optometrist/appointments') }}">
                        <iconify-icon icon="mdi:calendar-outline" width="20" height="20"></iconify-icon>
                        <span> Appointment</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>
