<header class="main-header py-2 px-4 d-flex justify-content-between align-items-center bg-white shadow-sm rounded">
    <h5 class="mb-0 fw-semibold text-primary">
        <a href="{{ route('ecommerce')}}" class="text-decoration-none text-primary">E Commerce</a>
    </h5>
    
    <div class="d-flex align-items-center gap-3">
        <!-- Cart Icon -->
        @auth
            
        <a href="{{ route('cart.index') }}" class="text-dark position-relative">
            <i class="bi bi-cart fs-4"></i>
            @if(session('cart') && count(session('cart')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                    <span class="visually-hidden">items in cart</span>
                </span>
            @endif
        </a>
        @endauth

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" id="profileDropdown"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/default-avatar.png') }}" alt="Profile" width="36" height="36" class="rounded-circle me-2">
                <span class="fw-semibold text-dark">
                    {{ Auth::user()->name ?? 'Guest' }}
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown">
                <li class="px-3 py-2 border-bottom">
                    <div class="d-flex flex-column">
                        <span class="fw-semibold">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                    </div>
                </li>
                <li class="px-3 py-2 border-bottom">
                    <div class="d-flex flex-column">
                        @auth
                            <a href="{{ route('orders') }}" class="text-decoration-none text-primary">My Orders</a>
                        @endauth
                    </div>
                </li>
                @if (Auth::check())
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a class="dropdown-item text-primary" href="{{ route('login') }}"><i class="bi bi-person-circle me-2"></i> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</header>
