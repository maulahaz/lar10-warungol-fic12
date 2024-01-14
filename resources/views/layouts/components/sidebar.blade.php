<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">WarungMHz</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">MHz</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('home') }}">Sub Menu-1</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('home') }}">Sub Menu-2</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('users') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('users') }}"><i class="fa fa-users">
                    </i> <span>Users</span>
                </a>
            </li>
            <li class="{{ Request::is('category') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('category') }}"><i class="fas fa-tags">
                    </i> <span>Categories</span>
                </a>
            </li>
            <li class="{{ Request::is('product') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('product') }}"><i class="fas fa-star">
                    </i> <span>Products</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
