<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="@route('admin.dashboard')">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <li class="nav-item">
                <a class="nav-link" href="@route('admin.employee.list')">
                    <i class="bi bi-grid"></i>
                    <span>Employee</span>
                </a>
            </li><!-- End billing Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Restore</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-link" href="@route('admin.billing.softDeleteData')">
                            <i class="bi bi-grid"></i>
                            <span>Restore Bill</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="@route('admin.employee.softdeleteData')">
                            <i class="bi bi-grid"></i>
                            <span>Restore Employee</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->
        @endif
        @if (Auth::user()->role_id == 1)
            <li class="nav-item">
                <a class="nav-link" href="@route('admin.filter')">
                    <i class="bi bi-grid"></i>
                    <span>Bill Filter</span>
                </a>
            </li><!-- End billing Nav -->
        @endif

        <li class="nav-item">
            <a class="nav-link" href="@route('admin.billing.list')">
                <i class="bi bi-grid"></i>
                <span>Billing List</span>
            </a>
        </li><!-- End billing Nav -->



        <li class="nav-item">
            <a class="nav-link" href="@route('admin.billing.create')">
                <i class="bi bi-grid"></i>
                <span>Billing Create</span>
            </a>
        </li><!-- End billing Nav -->



        <li class="nav-item">
            <a class="nav-link" href="@route('admin.logout')">
                <i class="bi bi-grid"></i>
                <span>Logout</span>
            </a>
        </li><!-- End billing Nav -->




    </ul>
</aside>
