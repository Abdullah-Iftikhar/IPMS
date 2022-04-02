<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true"
     data-img="{{ url('public/assets/dashboard/app-assets/images/backgrounds/02.')}}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item m-auto">
                <a class="navbar-brand" href="#">
                    Ilyas Properties
{{--                    <img class="brand-logo" alt="" src="{{ asset('nav-icon.png') }}"/>--}}
                </a>
            </li>

            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>

            <li class="nav-item">
                <a href="#" class="nav-link mainmenu-icon">
                    <img class="brand-logo" alt="" src="{{asset('app-assets/images/icons/Grid_Icon1.svg')}}"/>
                </a>
            </li>
        </ul>
    </div>

    <div class="navigation-background"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item">
                <a href="{{route('admin.dashboard')}}">
                    <i class="ft-home"></i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li class=" nav-item clients">
                <a href="#">
                    <i class="ft-list"></i>
                    <span class="menu-title" data-i18n="">Properties</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.property.list")}}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("admin.property.add")}}">
                            <span data-i18n="">Add</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("admin.property.sold")}}">
                            <span data-i18n="">Sold</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("admin.property.rented")}}">
                            <span data-i18n="">Rented</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item clients">
                <a href="#">
                    <i class="ft-activity"></i>
                    <span class="menu-title" data-i18n="">Construction</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.construction.material.list")}}">
                            <span data-i18n="">Material List</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route("admin.property.construction")}}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item clients">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span class="menu-title" data-i18n="">Acc Management</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.bank.list")}}">
                            <span data-i18n="">Banks</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route("admin.bank.account.list")}}">
                            <span data-i18n="">Account</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item clients">
                <a href="#">
                    <i class="ft-file"></i>
                    <span class="menu-title" data-i18n="">Reports</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.report.index","sold")}}">
                            <span data-i18n="">Sell</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route("admin.report.index", "rent")}}">
                            <span data-i18n="">Rent</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item clients">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Employee</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.employee.list")}}">
                            <span data-i18n="">List</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route("admin.salaries.list")}}">
                            <span data-i18n="">Salaries</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item clients">
                <a href="#">
                    <i class="ft-settings"></i>
                    <span class="menu-title" data-i18n="">Settings</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{route("admin.settings.profile")}}">
                            <span data-i18n="">Profile</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route("admin.users.list")}}">
                            <span data-i18n="">System Users</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
