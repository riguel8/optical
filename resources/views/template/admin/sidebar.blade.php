<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Auth::check() && Auth::user()->usertype === 'admin')
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <iconify-icon icon="ic:outline-dashboard" width="20" height="20"></iconify-icon>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/patients') ? 'active' : '' }}">
                        <a href="{{ url('admin/patients') }}">
                            <iconify-icon icon="fluent:patient-32-filled" width="20" height="20"></iconify-icon>
                            <span> Patients</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/appointments') ? 'active' : '' }}">
                        <a href="{{ url('admin/appointments') }}">
                            <iconify-icon icon="mdi:calendar-outline" width="20" height="20"></iconify-icon>
                            <span> Appointment</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/eyewears') ? 'active' : '' }}">
                        <a href="{{ url('admin/eyewears') }}">
                            <iconify-icon icon="material-symbols:eyeglasses" width="20" height="20"></iconify-icon>
                            <span> Eyewears</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/chatbot') ? 'active' : '' }}">
                        <a href="{{ url('admin/chatbot') }}">
                            <iconify-icon icon="tabler:message-chatbot" width="20" height="20"></iconify-icon>
                            <span> Chatbot</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                        <a href="{{ url('admin/users') }}">
                            <iconify-icon icon="mdi:users-check-outline" width="20" height="20"></iconify-icon>
                            <span> Users</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/reports') ? 'active' : '' }}">
                        <a href="" class="disabled">
                            <iconify-icon icon="lsicon:pie-two-outline" width="20" height="20"></iconify-icon>
                            <span> Reports</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/system-info') ? 'active' : '' }}">
                        <a href="{{ url('admin/system-info') }}">
                            <iconify-icon icon="mdi:settings-sync-outline" width="20" height="20"></iconify-icon>
                            <span> Settings</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
