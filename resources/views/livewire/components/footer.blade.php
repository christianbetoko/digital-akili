 <footer id="footer" class="footer position-relative dark-background">

   <livewire:components.newletter></livewire:components.newletter>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('home') }}" class="d-flex align-items-center">
            <span class="sitename">{{ $enterprise->name }}</span>
            
          </a>
          <div class="footer-contact pt-3">
            <p>{{ $enterprise->address }}</p>
           
            <p class="mt-3"><strong>Téléphone:</strong> <span>{{ $enterprise->phone }}</span></p>
            <p><strong>Email:</strong> <span>{{ $enterprise->email }}</span></p>
          </div>
        </div>

        <div class="col-lg-4 col-md-3 footer-links">
          <h4>Liens rapides</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('home')}}">Accueil</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('about')}}">A propos</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('services')}}">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('team')}}">Equipe</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="{{route('contact')}}">Contact</a></li>
          </ul>
        </div>

        

        <div class="col-lg-4 col-md-12">
          <h4>Nous suivre sur les réseaux sociaux</h4>
          <p></p>
          <div class="social-links d-flex">
            @foreach ($socials as $social)
              <a href="{{ $social->url }}" target="_blank">
                <i class="{{ $social->icon }}"></i>
              </a>
            @endforeach
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">DIGITAL AKILI SARL</strong> <span>Tous droits réservés.</span></p>
      <div class="credits" hidden>
      
        Designed by <a href="https://christianbetoko.dev/">Christian Betoko</a>
      </div>
    </div>

  </footer>