<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.category')}}" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Category</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{route('admin.slider')}}" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title"> Slider </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.brand')}}" aria-expanded="false" aria-controls="form-elements">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title"> Brand </span>
                </a>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.product')}}" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title"> Product </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.order')}}" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title"> Order </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{route('logout')}}" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title"> Logout </span>
            </a>
        </li>
    </ul>
</nav>
