<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            eShop
        </div>
        <div class="sidebar-brand-text">Admin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if($activeMenu == 'home') active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Admin
    </div>
    <li class="nav-item @if($activeMenu == 'category') active @endif">
        <a class="nav-link @if($activeMenu != 'category') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
            <i class="far fa-fw fa-building"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse @if($activeMenu == 'category') show @endif" aria-labelledby="headingCategory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category</h6>
                <a class="collapse-item @if($activeSubMenu == 'create-category') active @endif" href="{{ route('category.create') }}">Create Category</a>
                <a class="collapse-item @if($activeSubMenu == 'all-category') active @endif" href="{{ route('category.index') }}">All Categories</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if($activeMenu == 'sub-category') active @endif">
        <a class="nav-link @if($activeMenu != 'sub-category') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseSubCategory" aria-expanded="true" aria-controls="collapseSubCategory">
            <i class="fa fa-fw fa-database"></i>
            <span>Sub Category</span>
        </a>
        <div id="collapseSubCategory" class="collapse @if($activeMenu == 'sub-category') show @endif" aria-labelledby="headingSubCategory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sub Category</h6>
                <a class="collapse-item @if($activeSubMenu == 'create-sub-category') active @endif" href="{{ route('sub-category.create') }}">Create Sub Category</a>
                <a class="collapse-item @if($activeSubMenu == 'all-sub-category') active @endif" href="{{ route('sub-category.index') }}">All Sub Categories</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if($activeMenu == 'product') active @endif">
        <a class="nav-link @if($activeMenu != 'product') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
            <i class="fa fa-fw fa-cart-plus"></i>
            <span>Product</span>
        </a>
        <div id="collapseProduct" class="collapse @if($activeMenu == 'product') show @endif" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Product</h6>
                <a class="collapse-item @if($activeSubMenu == 'create-product') active @endif" href="{{ route('product.create') }}">Create Product</a>
                <a class="collapse-item @if($activeSubMenu == 'all-products') active @endif" href="{{ route('product.index') }}">All Products</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if($activeMenu == 'slider') active @endif">
        <a class="nav-link @if($activeMenu != 'slider') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseSlider" aria-expanded="true" aria-controls="collapseProduct">
            <i class="fa fa-fw fa-file-video"></i>
            <span>Slider</span>
        </a>
        <div id="collapseSlider" class="collapse @if($activeMenu == 'slider') show @endif" aria-labelledby="headingSlider" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Slider</h6>
                <a class="collapse-item @if($activeSubMenu == 'create-slider') active @endif" href="{{ route('slider.create') }}">Create Slider</a>
                <a class="collapse-item @if($activeSubMenu == 'all-sliders') active @endif" href="{{ route('slider.index') }}">All Sliders</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if($activeMenu == 'user') active @endif">
        <a class="nav-link @if($activeMenu != 'user') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseProduct">
            <i class="far fa-fw fa-user"></i>
            <span>User</span>
        </a>
        <div id="collapseUser" class="collapse @if($activeMenu == 'user') show @endif" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User</h6>
                <a class="collapse-item @if($activeSubMenu == 'all-users') active @endif" href="{{ route('users.index') }}">All Users</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i>
            <span><strong>Logout</strong></span></a>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    <!-- <div class="copyright text-center my-auto">
        <span>copyright &copy; <script>
                document.write(new Date().getFullYear());
            </script> - developed by
            <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
        </span>
    </div> -->
</ul>
<!-- Sidebar -->
