        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ url('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ assets('') }}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ assets('') }}/assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ url('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ assets('') }}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ assets('') }}/assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/dashboard') }}" class="nav-link" data-key="t-overview">
                                            View Statistics </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Manage Stores -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarStores" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarStores">
                                <i class="mdi mdi-account-multiple-outline"></i> <span data-key="t-tenants">Manage Stores</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarStores">
                                <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                        <a href="{{ url('admin/Users') }}" class="nav-link" data-key="t-list">
                                            Manage Users </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/stores') }}" class="nav-link" data-key="t-list">
                                            Store List </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/stores/create') }}" class="nav-link" data-key="t-create">
                                            Create New Tenant </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Subscriptions -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarSubscriptions" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarSubscriptions">
                                <i class="mdi mdi-cash"></i> <span data-key="t-subscriptions">Subscriptions</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarSubscriptions">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/subscriptions') }}" class="nav-link" data-key="t-manage">
                                            View Subscriptions </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/trials/manage') }}" class="nav-link" data-key="t-expire">
                                            Manage Trial Periods </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/plans') }}" class="nav-link" data-key="t-manage">
                                            Manage Plans </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Invoices -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarInvoices" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarInvoices">
                                <i class="mdi mdi-receipt"></i> <span data-key="t-invoices">Invoices</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarInvoices">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/invoices') }}" class="nav-link" data-key="t-view">
                                            View Invoices </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/invoices/create') }}" class="nav-link" data-key="t-generate">
                                            Generate Invoice </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Notifications -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('admin/notifications') }}" data-key="t-notifications">
                                <i class="mdi mdi-bell-outline"></i> <span>Notifications</span>
                            </a>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a href="{{ url('admin/settings') }}" class="nav-link" data-key="t-settings">
                                <i class="mdi mdi-cog-outline"></i> <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                    @endif

                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>