<div>
     <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="current">À propos</li>
          </ol>
        </nav>
        <h1>À propos</h1>
      </div>
    </div><!-- End Page Title -->

 <!-- About Section -->
    <section id="about" class="section about">
        

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-12 order-1 order-lg-2">
            <img src="{{ asset('storage/' . $enterprise->logo_with_bg) }}" class="img-fluid" alt="{{$enterprise->name}}">
          <br><br>
            <h3>{{$enterprise->name}}</h3>
           
              {!!$enterprise->description!!}
            
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">
<!-- Titre de la Section Statistiques -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Statistiques</h2>
            <p>Digital Akili en chiffres</p>
        </div><!-- End Section Title -->
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
@if($stats->isNotEmpty())
@foreach ($stats as $stat)
    <div class="col-lg-3 col-md-6">
            <div class="stats-item">
              <i class="{{$stat->icon}}"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{$stat->number}}" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>{{$stat->title}}</strong> <span></span></p>
            </div>
          </div>
@endforeach
          

          @endif

        </div>

      </div>

    </section><!-- /Stats Section -->

</div>
