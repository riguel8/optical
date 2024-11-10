<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Auth::check() && Auth::user()->usertype === 'admin')
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a href="{{ url('admin/dashboard') }}"><i class="fe fe-grid"></i><span> Dashboard</span></a></li>
                    <li class="{{ request()->is('admin/patients') ? 'active' : '' }}"><a href="{{ url('admin/patients') }}"><i class="fe fe-users"></i><span> Patients</span></a></li>
                    <li class="{{ request()->is('admin/appointments') ? 'active' : '' }}"><a href="{{ url('admin/appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
                    <li class="{{ request()->is('admin/eyewears') ? 'active' : '' }}"><a href="{{ url('admin/eyewears') }}"><iconify-icon icon="bi:eyeglasses" width="18" height="18"></iconify-icon><span> Eyewears</span></a></li>
                    <li class="{{ request()->is('admin/users') ? 'active' : '' }}"><a href="{{ url('admin/users') }}"><i class="fe fe-user-check"></i><span> Users</span></a></li>
                    <li class="{{ request()->is('admin/reports') ? 'active' : '' }}"><a href="" class="disabled"><i class="fe fe-file-text"></i><span> Reports</span></a></li>
                    <li class="{{ request()->is('admin/system-info') ? 'active' : '' }}"><a href="{{ url('admin/system-info') }}"><iconify-icon icon="hugeicons:system-update-01" width="18" height="18"></iconify-icon><span> Settings</span></a></li>

                @endif
            </ul>
        </div>
    </div>
</div>
