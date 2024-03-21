<div class="sidebar sidebar-style-2">           
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('images/avatar.png') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
                            <span class="user-level">{{ Auth::user()->roles()->first()->name }}</span>
                            <!-- <span class="caret"></span> -->
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                @can('View Dashboard')
                <li class="nav-item {{ (request()->is(['dashboard'])) ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endcan

                @can('View Document Manager')
                <li class="nav-item {{ (request()->is(['document', 'document/new', 'document/update', 'document/view'])) ? 'active' : '' }}">
                    <a href="{{ route('document') }}">
                        <i class="fas fa-file"></i>
                        <span>Document Manager</span>
                    </a>
                </li>
                @endcan
                @can('View File Uploader')
                <li class="nav-item {{ (request()->is(['file', 'file/upload'])) ? 'active' : '' }}">
                    <a href="{{ route('file') }}">
                        <i class="fas fa-upload"></i>
                        <span>File Manager</span>
                    </a>
                </li>
                @endcan

                @can('View Reports')
                <li class="nav-item {{ (request()->is(['reports'])) ? 'active' : '' }}">
                    <a href="{{ route('reports') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endcan

                @can('System Settings Menu')
                <li class="nav-item waves-effect waves-block {{ (request()->is(['category', 'permissions', 'roles', 'user', 'settings'])) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-cog"></i>
                        <p>Maintenance</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ (request()->is(['category', 'permissions', 'roles', 'user', 'settings'])) ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            @can('View Document Categories')
                            <li class="{{ (request()->is('category')) ? 'active' : '' }}">
                                <a href="{{ route('category') }}" class="{{ (request()->is('category')) ? 'toggled' : '' }} waves-effect waves-block">
                                    <span class="sub-item">Category</span>
                                </a>
                            </li>
                            @endcan
                            @can('View Permissions')
                            <li class="{{ (request()->is('permissions')) ? 'active' : '' }}">
                                <a href="{{ route('permissions') }}" class="{{ (request()->is('permissions')) ? 'toggled' : '' }} waves-effect waves-block">
                                    <span class="sub-item">Permissions</span>
                                </a>
                            </li>
                            @endcan
                            @can('View Roles')
                            <li class="{{ (request()->is('roles')) ? 'active' : '' }}">
                                <a href="{{ route('roles') }}" class="{{ (request()->is('roles')) ? 'toggled' : '' }} waves-effect waves-block">
                                    <span class="sub-item">Roles</span>
                                </a>
                            </li>
                            @endcan
                            @can('View User Accounts')
                            <li class="{{ (request()->is('user')) ? 'active' : '' }}">
                                <a href="{{ route('user') }}" class="{{ (request()->is('user')) ? 'toggled' : '' }} waves-effect waves-block">
                                    <span class="sub-item">User Accounts</span>
                                </a>
                            </li>
                            @endcan
                            @can('View Settings')
                            <li class="{{ (request()->is('settings')) ? 'active' : '' }}">
                                <a href="{{ route('settings') }}" class="{{ (request()->is('settings')) ? 'toggled' : '' }} waves-effect waves-block">
                                    <span class="sub-item">System Setup</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>