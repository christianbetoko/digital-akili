<div>
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li ><a href="{{ route('realisations') }}">Réalisations</a></li>
            <li class="current">{{ $portfolio->name }}</li> 
          </ol>
        </nav>
        <h1>{{ $portfolio->name }}</h1>
      </div>
    </div><!-- End Page Title -->

  <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">

              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>

              <div class="swiper-wrapper align-items-center">
@foreach ($portfolio->images as $image)
                <div class="swiper-slide">
                  <img src="{{asset('storage/'. $image)}}" alt="{{ $portfolio->name }}">
                </div>
    
@endforeach
                

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <h3>informations sur la réalisation</h3>
              <ul>
             
               @if($portfolio->client) <li><strong>Client</strong>: {{ $portfolio->client }}</li> @endif
               @if($portfolio->partenaire) <li><strong>Partenaire</strong>: {{ $portfolio->partenaire }}</li> @endif
                @if($portfolio->year) <li><strong>Année</strong>: {{ $portfolio->year }}</li> @endif
                @if($portfolio->link) <li><strong>Lien</strong>: <a href="{{ $portfolio->link }}" target="_blank">Voir le projet</a></li> @endif
              </ul>
            </div>
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
              <h2>{{ $portfolio->name }}</h2>
              {!! $portfolio->description !!}
             
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

</div>
