<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="@route('dashboard')">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link" href="@route('billing.list')">
                <i class="bi bi-grid"></i>
                <span>Billing List</span>
            </a>
        </li><!-- End billing Nav -->

        <li class="nav-item">
            <a class="nav-link" href="@route('billing.trash.list')">
                <i class="bi bi-grid"></i>
                <span>Trash Billing List</span>
            </a>
        </li><!-- End billing Nav -->

        <li class="nav-item">
            <a class="nav-link" href="@route('billing.create')">
                <i class="bi bi-grid"></i>
                <span>Billing Create</span>
            </a>
        </li><!-- End billing Nav -->

        <li class="nav-item">
            <a class="nav-link" href="@route('profile.edit')">
                <i class="bi bi-grid"></i>
                <span>Profile</span>
            </a>
        </li><!-- End billing Nav -->

        <li class="nav-item">
            <a class="nav-link" href="@route('role.index')">
                <i class="bi bi-grid"></i>
                <span>Role</span>
            </a>
        </li><!-- End role Nav -->


        <li class="nav-item">
            <a class="nav-link" href="@route('permission.index')">
                <i class="bi bi-grid"></i>
                <span>Permission</span>
            </a>
        </li><!-- End permission Nav -->


        {{-- @isset(auth()->user()->role->permission['permission']['permission']['list'])
                <li>
                    <a href="@route('permission.index')">
                        <i class="bi bi-circle"></i><span>List of permission</span>
                    </a>
                </li>
                @endisset
                @isset(auth()->user()->role->permission['permission']['permission']['add'])
                <li>
                    <a href="@route('permission.create')">
                        <i class="bi bi-circle"></i><span>Permission Create</span>
                    </a>
                </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="@route('logout')">
                <i class="bi bi-grid"></i>
                <span>Logout</span>
            </a>
        </li><!-- End billing Nav -->




    </ul>
</aside>
