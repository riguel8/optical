<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Auth::check() && Auth::user()->usertype === 'staff')
                    <li class="{{ request()->is('staff/dashboard') ? 'active' : '' }}"><a href="{{ url('staff/dashboard') }}"><i class="fe fe-grid"></i><span> Dashboard</span></a></li>
                    <li class="{{ request()->is('staff/patients') ? 'active' : '' }}"><a href="{{ url('staff/patients') }}"><i class="fe fe-users"></i><span> Patients</span></a></li>
                    <li class="{{ request()->is('staff/appointments') ? 'active' : '' }}"><a href="{{ url('staff/appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
                    <li class="{{ request()->is('staff/eyewears') ? 'active' : '' }}"><a href="{{ url('staff/eyewears') }}"><iconify-icon icon="bi:eyeglasses" width="18" height="18"></iconify-icon><span> Eyewears</span></a></li>
                    <li class="{{ request()->is('staff/chatbot') ? 'active' : '' }}"><a href="{{ url('staff/chatbot') }}"><iconify-icon icon="teenyicons:chatbot-outline" width="18" height="18"></iconify-icon><span> Chatbot</span></a></li>
                    <li class="{{ request()->is('staff/reports') ? 'active' : '' }}"><a href="" class="disabled"><i class="fe fe-file-text"></i><span> Reports</span></a></li>
                    <li class="{{ request()->is('staff/settings') ? 'active' : '' }}"><a href="" class="disabled"><i class="fe fe-settings"></i><span> Settings</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
