<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            @if (Auth::check() && Auth::user()->usertype === 'client')
                <li class="{{ request()->is('client/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('client/dashboard') }}">
                        <iconify-icon icon="ic:outline-dashboard" width="20" height="20"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/appointments') ? 'active' : '' }}">
                    <a href="{{ url('client/appointments') }}">
                        <iconify-icon icon="mdi:calendar-outline" width="20" height="20"></iconify-icon>
                        <span>Appointment</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/prescription') ? 'active' : '' }}">
                    <a href="{{ url('client/prescription') }}">
                        <iconify-icon icon="mdi:prescription" width="20" height="20"></iconify-icon>
                        <span>Prescription</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/eyewears') ? 'active' : '' }}">
                    <a href="{{ url('client/eyewears') }}">
                        <iconify-icon icon="material-symbols:eyeglasses" width="20" height="20"></iconify-icon>
                        <span>Eyewear</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/account_details') ? 'active' : '' }}">
                    <a href="{{ url('client/account_details') }}">
                        <iconify-icon icon="material-symbols:manage-accounts-outline" width="20" height="20"></iconify-icon>
                        <span>Account Details</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>

