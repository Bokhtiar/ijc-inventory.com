<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link"
                @if (Auth::user()->role_id == 4) href="@route('profile.edit', Auth::id())"
                @else 
                href="@route('dashboard')" @endif>
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @isset(auth()->user()->role->permission['permission']['billing']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('billing.list')">
                    <i class="bi bi-grid"></i>
                    <span>Billing List</span>
                </a>
            </li><!-- End billing Nav -->
        @endisset
        @isset(auth()->user()->role->permission['permission']['billing']['add'])
            <li class="nav-item">
                <a class="nav-link" href="@route('billing.create')">
                    <i class="bi bi-grid"></i>
                    <span>Billing Create</span>
                </a>
            </li><!-- End billing Nav -->
        @endisset
        @isset(auth()->user()->role->permission['permission']['role']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('role.index')">
                    <i class="bi bi-grid"></i>
                    <span>Role</span>
                </a>
            </li><!-- End role Nav -->
        @endisset
        @isset(auth()->user()->role->permission['permission']['permission']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('permission.index')">
                    <i class="bi bi-grid"></i>
                    <span>Permission</span>
                </a>
            </li><!-- End permission Nav -->
        @endisset
        @isset(auth()->user()->role->permission['permission']['employee']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('employee.index')">
                    <i class="bi bi-grid"></i>
                    <span>Employee</span>
                </a>
            </li><!-- End employee Nav -->
        @endisset

        @isset(auth()->user()->role->permission['permission']['customer']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('customer.index')">
                    <i class="bi bi-grid"></i>
                    <span>Customer</span>
                </a>
            </li><!-- End customer Nav -->
        @endisset

        @isset(auth()->user()->role->permission['permission']['report']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('report.index', 'today')">
                    <i class="bi bi-grid"></i>
                    <span>Report</span>
                </a>
            </li><!-- End employee Nav -->
        @endisset

        @isset(auth()->user()->role->permission['permission']['setting']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('setting.edit', 1)">
                    <i class="bi bi-grid"></i>
                    <span>Setting</span>
                </a>
            </li><!-- End setting Nav -->
        @endisset
        @isset(auth()->user()->role->permission['permission']['contact']['list'])
            <li class="nav-item">
                <a class="nav-link" href="@route('contact.index')">
                    <i class="bi bi-grid"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End contact Nav -->
        @endisset
        <li class="nav-item">
            <a class="nav-link" href="@route('logout')">
                <i class="bi bi-grid"></i>
                <span>Logout</span>
            </a>
        </li><!-- End billing Nav -->
    </ul>
</aside>
