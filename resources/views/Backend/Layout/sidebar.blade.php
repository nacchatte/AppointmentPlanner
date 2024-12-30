<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Appointment</span></li>

                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('appointments.index') }}" aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Calendar View
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('appointments.table') }}" aria-expanded="false"><i data-feather="layout" class="feather-icon"></i><span class="hide-menu">Table View
                        </span></a>
                </li>
                
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('sales-reports') }}" aria-expanded="false"><i data-feather="file" class="feather-icon"></i><span class="hide-menu">Sales Report</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('appointments.create') }}" aria-expanded="false"><i data-feather="plus" class="feather-icon"></i><span class="hide-menu">Add Appointment</span></a>
                </li>
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Customer</span></li>


                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('customer.index') }}" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">View Customer
                        </span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('customer.create') }}" aria-expanded="false"><i data-feather="plus" class="feather-icon"></i><span class="hide-menu">Add New Customer</span></a>
                </li>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Staff</span></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('staffview') }}" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">View Staff </span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('staff.create') }}" aria-expanded="false"><i data-feather="plus" class="feather-icon"></i><span class="hide-menu">Add Staff </span></a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>