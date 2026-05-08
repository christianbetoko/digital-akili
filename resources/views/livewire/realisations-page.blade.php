<div>
     <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="current">Réalisations</li>
          </ol>
        </nav>
        <h1>Nos réalisations</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

         
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
@if($portfolios->isNotEmpty())
@foreach ($portfolios as $portfolio)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item ">
              <div class="portfolio-content h-100">
                <img src="{{asset('storage/'. $portfolio->images[0])}}" class="img-fluid" alt="{{$portfolio->name}}">
                <div class="portfolio-info">
                  <h4>{{$portfolio->name}}</h4>
                  {!!Str::limit($portfolio->description, 100)!!}
                  <a href="{{asset('storage/'. $portfolio->images[0])}}" title="{{$portfolio->name}}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="{{ route('realisation', $portfolio->slug) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
    
@endforeach
            
@endif
           

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->
</div>
