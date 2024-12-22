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
                    @if(Auth::check())
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
                                        <a href="{{ url('tenant/dashboard') }}" class="nav-link" data-key="t-details">
                                            View Subscription Details </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('tenant/trials') }}" class="nav-link" data-key="t-trials">
                                            Check Trial Period </a>
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
                                        <a href="{{ url('tenant/invoices') }}" class="nav-link" data-key="t-view">
                                            View Invoices </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('tenant/invoices/pay') }}" class="nav-link" data-key="t-pay">
                                            Make Payment </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Subscription Plans -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarSubscriptions" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarSubscriptions">
                                <i class="mdi mdi-cash"></i> <span data-key="t-subscriptions">Subscription Plans</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarSubscriptions">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('tenant/subscriptions') }}" class="nav-link" data-key="t-review">
                                            Review Plans </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('tenant/subscriptions/upgrade') }}" class="nav-link" data-key="t-upgrade">
                                            Upgrade or Change Plan </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('tenant/subscriptions/request-trial') }}" class="nav-link" data-key="t-request">
                                            Request Free Trial </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="{{ url('tenant/profile') }}" class="nav-link" data-key="t-profile">
                                <i class="mdi mdi-account-circle-outline"></i> <span>Profile</span>
                            </a>
                        </li>

                        <!-- Support -->
                        <li class="nav-item">
                            <a href="{{ url('tenant/support') }}" class="nav-link" data-key="t-support">
                                <i class="mdi mdi-lifebuoy"></i> <span>Support</span>
                            </a>
                        </li>
                    </ul>

                    @endif

                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>