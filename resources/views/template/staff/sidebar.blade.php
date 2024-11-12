<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Auth::check() && Auth::user()->usertype === 'staff')
                    <li class="{{ request()->is('staff/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('staff/dashboard') }}">
                            <iconify-icon icon="ic:outline-dashboard" width="20" height="20"></iconify-icon>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/patients') ? 'active' : '' }}">
                        <a href="{{ url('staff/patients') }}">
                            <iconify-icon icon="fluent:patient-32-filled" width="20" height="20"></iconify-icon>
                            <span> Patients</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/appointments') ? 'active' : '' }}">
                        <a href="{{ url('staff/appointments') }}">
                            <iconify-icon icon="mdi:calendar-outline" width="20" height="20"></iconify-icon>
                            <span> Appointment</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/eyewears') ? 'active' : '' }}">
                        <a href="{{ url('staff/eyewears') }}">
                            <iconify-icon icon="material-symbols:eyeglasses" width="20" height="20"></iconify-icon>
                            <span> Eyewears</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/chatbot') ? 'active' : '' }}">
                        <a href="{{ url('staff/chatbot') }}">
                            <iconify-icon icon="tabler:message-chatbot" width="20" height="20"></iconify-icon>
                            <span> Chatbot</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/reports') ? 'active' : '' }}">
                        <a href="" class="disabled">
                            <iconify-icon icon="lsicon:pie-two-outline" width="20" height="20"></iconify-icon>
                            <span> Reports</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('staff/settings') ? 'active' : '' }}">
                        <a href="" class="disabled">
                            <iconify-icon icon="mdi:settings-sync-outline" width="20" height="20"></iconify-icon>
                            <span> Settings</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
