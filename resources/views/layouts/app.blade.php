<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel')</title>

    @include('layouts.partials.header-script')

    <style>
      :root {
        --sidebar-width: 270px;
        --sidebar-height: 90vh;
        --sidebar-bg: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        --transition-speed: 0.3s;
      }

      body {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #f8fafc;
      }

      /* === Header === */
      .main-header {
        position: sticky;
        top: 0;
        z-index: 1040;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      }

      /* === Sidebar === */
      .sidebar {
        width: var(--sidebar-width);
        height: var(--sidebar-height);
        background: var(--sidebar-bg);
        color: #fff;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        overflow: hidden;
        position: sticky;
        top: 1rem;
      }

      .sidebar .sidebar-header {
        padding: 1.25rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        font-weight: 600;
        letter-spacing: 0.5px;
      }

      .sidebar .sidebar-menu {
        flex: 1;
        overflow-y: auto;
        padding: 0.75rem;
        -webkit-overflow-scrolling: touch;
      }

      .sidebar-footer {
        padding: 0.75rem 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        background: rgba(255, 255, 255, 0.05);
      }

      .nav-link.sidebar-link {
        display: flex;
        align-items: center;
        color: rgba(255,255,255,0.9);
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.65rem 0.85rem;
        transition: background var(--transition-speed), transform var(--transition-speed);
      }

      .nav-link.sidebar-link .bi {
        margin-right: 0.75rem;
        font-size: 1.1rem;
      }

      .nav-link.sidebar-link:hover,
      .nav-link.sidebar-link.active {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: translateX(4px);
      }

      .sidebar-footer a {
        color: #fff;
        text-decoration: none;
        opacity: 0.9;
      }
      .sidebar-footer a:hover {
        opacity: 1;
        text-decoration: underline;
      }

      /* === Content === */
      main {
        flex-grow: 1;
        min-height: 100vh;
      }

      .card {
        border: none;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        border-radius: 1rem;
      }

      @media (max-width: 992px) {
        .d-flex.gap-4 {
          flex-direction: column;
        }
        .sidebar {
          width: 100%;
          height: auto;
          border-radius: 0.75rem;
          position: relative;
        }
      }
    </style>
</head>

<body>
    @auth
      @include('layouts.partials.header')
    @endauth

    <div class="container-fluid py-4">
      <div class="d-flex gap-4">
        @auth
          @include('layouts.partials.sidebar')
        @endauth

        <main class="flex-grow-1">
            @include('layouts.partials.flash-message')
          <div class="card">
            <div class="card-body p-4">
              @yield('content')
            </div>
          </div>
        </main>
      </div>
    </div>

    @include('layouts.partials.footer-script')
</body>
</html>
