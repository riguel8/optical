<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            @if (Auth::check() && Auth::user()->usertype === 'client')
                <li class="{{ request()->is('client/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('client/dashboard') }}">
                        <iconify-icon icon="material-symbols-light:dashboard-outline-rounded" width="18" height="18"></iconify-icon><span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/appointments') ? 'active' : '' }}">
                    <a href="{{ url('client/appointments') }}">
                        <iconify-icon icon="mdi-light:calendar" width="18" height="18"></iconify-icon></iconify-icon><span>Appointment</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/eyewears') ? 'active' : '' }}">
                    <a href="{{ url('client/eyewears') }}">
                    <iconify-icon icon="subway:glass" width="18" height="18"></iconify-icon><span>Eyewear</span>
                    </a>
                </li>
                <li class="{{ request()->is('client/account_details') ? 'active' : '' }}">
                    <a href="{{ url('client/account_details') }}">
                        <iconify-icon icon="carbon:order-details" width="18" height="18"></iconify-icon><span>Account Details</span>
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>

