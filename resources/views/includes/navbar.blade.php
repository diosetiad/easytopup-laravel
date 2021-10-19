<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img src="/images/logo.svg" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link">Categories</a>
            </li>
            @guest
                <li class="nav-item">
              <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign in</a>
            </li>
            @endguest
          </ul>

          @auth
              <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
                @if ($user->photo != null)
                  <img src="{{ Storage::url($user->photo) }}" class="rounded-circle mr-2 profile-picture">
                @else
                  <img src="/images/icon-testimonial-2.png" class="rounded-circle mr-2 profile-picture">
                @endif
                Hi, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu">
                @if (Auth::user()->roles == 'ADMIN')  
                  <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Dashboard</a>
                @else
                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                <a href="{{ route('dashboard-account') }}" class="dropdown-item"
                  >Settings</a
                >
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @if (Auth::user()->roles == 'USER')  
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                @php
                  $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                  <img src="/images/icon-cart-filled.svg" alt="" />
                  <div class="card-badge">{{ $carts }}</div>
                @else
                  <img src="/images/icon-cart-empty.svg" alt="" />
                @endif
              </a>
            </li>
            @endif
          </ul>

          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              @if (Auth::user()->roles == 'ADMIN')  
                <a href="{{ route('admin-dashboard') }}" class="nav-link">Hi, {{ Auth::user()->name }}</a>
              @else
              <a href="{{ route('dashboard') }}" class="nav-link">
                Hi, {{ Auth::user()->name }}
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                Cart
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
            </li>
          </ul>
          @endauth
        </div>
      </div>
    </nav>