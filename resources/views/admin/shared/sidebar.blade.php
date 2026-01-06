<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.home.index') }}" class="logo text-white fw-bold">後台管理</a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">主選單</h4>
                </li>

                <li class="nav-item active">
                    <a href="{{ route('admin.home.index') }}">
                        <i class="fas fa-home"></i> <p>主控台</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.meals.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.meals.index') }}">
                        <i class="fas fa-utensils"></i><p>餐點管理</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>