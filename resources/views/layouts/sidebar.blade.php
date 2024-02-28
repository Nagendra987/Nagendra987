<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('home')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'customers' ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('customers.index')}}">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Customers</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) == 'products' ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('products.index')}}">
                <i class="menu-icon mdi mdi-professional-hexagon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
    </ul>
</nav>