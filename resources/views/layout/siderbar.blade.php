<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PARALINE</span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 542px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                                 alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Admin</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    @php
                        $module_active=session('module_active');
                    @endphp
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item {{$module_active =='team' ? 'menu-is-opening menu-open': ''}}">
                                <a href="{{route("team.index")}}" class="nav-link {{$module_active =='team' ? 'active': ''}}">
                                    <i class="fa fa-th"></i>
                                    <p>
                                        Team
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="{{route("team.index")}}"
                                           class="nav-link {{(request()->is('management/team')) ? 'active':''}} ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <span>Search</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("team.create")}}"
                                           class="nav-link {{(request()->is('management/team/create')) ? 'active':''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <span>Create</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{$module_active =='employee' ? 'menu-is-opening menu-open': ''}}">
                                <a href="{{route("employee.index")}}"
                                   class="nav-link {{$module_active =='employee' ? 'active': ''}}">
                                    <i class="fa fa-th"></i>
                                    <p>
                                        Employee
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route("employee.index")}}"
                                           class="nav-link {{(request()->is('management/employee')) ? 'active':''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <span>Search</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("employee.create")}}"
                                           class="nav-link {{(request()->is('management/employee/create')) ? 'active':''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <span>Create</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 39.9558%; transform: translate(0px, 119.118px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
