<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @if(Auth::check() && Auth::user()->usertype === 'admin')
                    <li><a href="{{ url('admin/dashboard') }}"><i class="fe fe-grid"></i><span> Dashboard</span></a></li>
                    <li><a href="{{ url('admin/patients') }}"><i class="fe fe-users"></i><span> Patients</span></a></li>
                    <li><a href="{{ url('admin/appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
                    <li><a href="{{ url('admin/users') }}" class="disabled"><i class="fe fe-user-check"></i><span> Users</span></a></li>
                    <li class="disabled"><a href=""><i class="fe fe-file-text"></i><span> Reports</span></a></li>
                    <li class="disabled"><a href=""><i class="fe fe-settings"></i><span> Settings</span></a></li>
                @elseif (Auth::check() && Auth::user()->usertype === 'staff')
                    <li><a href="{{ url('patients') }}"><i class="fe fe-users"></i><span> Patients</span></a></li>
                    <li><a href="{{ url('appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
                @elseif (Auth::check() && Auth::user()->usertype === 'client')
                    <li><a href="{{ url('client/appointments') }}"><i class="fe fe-calendar"></i><span> Appointment</span></a></li>
                    <li><a href="{{ url('client/eyewears') }}"><i class="si si-eyeglass"></i><span> Eyewears</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
