<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu">
            <ul>
                <li><a href="{{ route('home') }}"><i class="la la-home"></i> <span>Back to Home</span></a></li>
                <li class="menu-title">Settings</li>
                <li class="{{set_active(['company/settings/page'])}}"><a href="{{ route('company/settings/page') }}"><i class="la la-building"></i><span>Company Settings</span></a></li>
                <li class="{{set_active(['roles/permissions/page'])}}"><a href="{{ route('roles/permissions/page') }}"><i class="la la-key"></i><span>Roles & Permissions</span></a></li>
                <li class="{{set_active(['rchange/password'])}}"><a href="{{ route('change/password') }}"><i class="la la-lock"></i><span>Change Password</span></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->