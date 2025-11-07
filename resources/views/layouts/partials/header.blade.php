<header class="main-header py-2 px-4 d-flex justify-content-between align-items-center shadow-sm bg-white">
  <h5 class="mb-0 fw-semibold text-primary">E-Commerce</h5>

  <div class="dropdown">
      <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name ?? 'Guest' }}
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown">
          <li class="px-3 py-2 border-bottom">
              <div class="d-flex flex-column">
                  <span class="fw-semibold">{{ Auth::user()->name }}</span>
                  <small class="text-muted">{{ Auth::user()->email }}</small>
              </div>
          </li>
          <li>
              <hr class="dropdown-divider">
          </li>
          <li>
              <form action="{{ route('logout') }}" method="POST" class="m-0">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                      <i class="bi bi-box-arrow-right me-2"></i> Logout
                  </button>
              </form>
          </li>
      </ul>
  </div>
</header>
