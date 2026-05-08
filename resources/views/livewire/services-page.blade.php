<div>
  <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="current">Services    </li>
          </ol>
        </nav>
        <h1>Services</h1>
      </div>
    </div><!-- End Page Title -->

  <!-- Services Section -->
    <section id="services" class="services section">

      <div class="container">

        <div class="row gy-4">
@if($services->isNotEmpty())
          @foreach($services as $service)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="{{$service->icon}}"></i>
              </div>
              <a href="{{ route('service', $service->slug) }}" class="stretched-link">
                <h3>{{ $service->name }}</h3>
              </a>
            
            </div>
          </div><!-- End Service Item -->
@endforeach
@endif
          

        </div>

      </div>

    </section><!-- /Services Section -->

</div>  
