<div>
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li ><a href="{{ route('services') }}">Services</a></li>
            <li class="current">{{ $service->name }}
          </ol>
        </nav>
        <h1>{{ $service->name }}</h1>
      </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

        <div class="container" data-aos="fade-up">
    
            <div class="row gy-4">
            <div class="col-lg-12">
                
                
                {!! $service->description !!}
            </div>
            </div>
    
        </div>
    
    </section><!-- /Service Details Section -->

</div>
