@section('title', $portfolio->name . ' | Digital Akili')

@section('meta_tags')
    <meta property="og:title" content="{{ $portfolio->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($portfolio->description), 160) }}">
    <meta property="og:image" content="{{ asset('storage/'.$portfolio->images[0]) }}">
    <meta property="og:type" content="article">

    <meta name="twitter:title" content="{{ $portfolio->name }}">    
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($portfolio->description), 160) }}">
    <meta name="twitter:image" content="{{ asset('storage/'.$portfolio->images[0]) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

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
              <div class="share-area">
                                <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm transition-all" 
                                        id="shareBtn"
                                        data-title="{{ $portfolio->name }}" 
                                        data-url="{{ url()->current() }}">
                                    <i class="bi bi-share-fill me-1"></i> Partager
                                </button>
                            </div>
            </div>
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
              <h2>{{ $portfolio->name }}</h2>
              {!! $portfolio->description !!}
             
            </div>
          

        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

</div>
<style>
    /* Animation et style du bouton partager */
    #shareBtn {
        transition: all 0.3s ease;
        border: none;
        background: linear-gradient(45deg, #0d6efd, #0a58ca);
    }

    #shareBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4) !important;
    }

    .content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
</style>

<script>
    document.getElementById('shareBtn').addEventListener('click', async function() {
        const title = this.getAttribute('data-title');
        const url = this.getAttribute('data-url');

        // 1. Essayer le partage natif (Mobile / Navigateurs récents)
        if (navigator.share) {
            try {
                await navigator.share({
                    title: title,
                    url: url
                });
            } catch (err) {
                console.log("Partage annulé ou erreur");
            }
        } 
        // 2. Fallback : Copier le lien si le partage natif n'existe pas
        else {
            try {
                await navigator.clipboard.writeText(url);
                
                // Feedback visuel sur le bouton
                const originalHTML = this.innerHTML;
                this.classList.replace('btn-primary', 'btn-success');
                this.innerHTML = '<i class="bi bi-check-lg"></i> Lien copié !';
                
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.classList.replace('btn-success', 'btn-primary');
                }, 2500);
            } catch (err) {
                alert("Impossible de copier le lien automatiquement. Voici l'URL : " + url);
            }
        }
    });
</script>