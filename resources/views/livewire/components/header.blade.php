

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center dark-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i style="color: white" class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{$enterprise->email}}">{{$enterprise->email}}</a></i>
          <i style="color: white"class="bi bi-phone d-flex align-items-center ms-4"><span>{{$enterprise->phone}}</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          @if ($socials->isNotEmpty())
            @foreach ($socials as $social)
              <a href="{{ $social->url }}" class="{{ $social->name }}" target="_blank">
                <i class="bi bi-{{ $social->icon }}"></i>
              </a>
            @endforeach
          @endif
          
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="{{asset('storage/'. $enterprise->logo_with_bg)}}" alt="{{ $enterprise->name }}" class="img-fluid">
        
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{route('home')}}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
            <li><a href="{{route('about')}}" class="{{ request()->routeIs('about') ? 'active' : '' }}">À propos</a></li>
             <li><a href="{{route('team')}}" class="{{ request()->routeIs('team') ? 'active' : '' }}">Equipe</a></li>
            <li><a href="{{route('services')}}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{route('realisations')}}" class="{{ request()->routeIs('realisations') ? 'active' : '' }}">Réalisations</a></li>
           
           
            <li><a href="{{route('blog')}}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Actualités</a></li>
           {{--  <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
              </ul>
            </li> --}}
            <li><a href="{{route('contact')}}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>
