<aside class="sidebar" aria-label="Main sidebar">
    <div class="sidebar-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <span class="fs-5 fw-semibold me-2"><i class="bi bi-speedometer2"></i></span>
            <div>
                <div class="fw-bold">E Commerce</div>
                {{-- <small>login as {{ Auth::user()->name }}</small> --}}
              
            </div>
        </div>
        {{-- <button class="btn btn-sm btn-light text-primary" aria-label="Toggle collapse (example)">☰</button> --}}
    </div>

    <!-- Scrollable menu area -->
    <nav class="sidebar-menu" role="navigation" aria-label="Sidebar navigation">
        <ul class="nav nav-pills flex-column gap-1">
    
            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
            </li>
    
            {{-- Product Management --}}
            <li class="nav-item">
                <a class="nav-link sidebar-link d-flex justify-content-between align-items-center 
                          {{ request()->routeIs('admin.products', 'admin.add-product') ? '' : 'collapsed' }}" 
                   data-bs-toggle="collapse"
                   href="#submenu1" role="button" 
                   aria-expanded="{{ request()->routeIs('admin.products', 'admin.add-product') ? 'true' : 'false' }}" 
                   aria-controls="submenu1">
                    <span><i class="bi bi-folder"></i> Product Management</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
    
                <div class="collapse {{ request()->routeIs('admin.products', 'admin.add-product') ? 'show' : '' }} ps-3" id="submenu1">
                    <a href="{{ route('admin.products') }}" 
                       class="nav-link sidebar-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                        Products
                    </a>
                    <a href="{{ route('admin.add-product') }}" 
                       class="nav-link sidebar-link {{ request()->routeIs('admin.add-product') ? 'active' : '' }}">
                        Add Product
                    </a>
                </div>
            </li>
    
            {{-- Orders --}}
            <li class="nav-item">
                <a href="{{ route('admin.orders') }}" 
                   class="nav-link sidebar-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Orders
                </a>
            </li>
    
        </ul>
    </nav>
    

</aside>
