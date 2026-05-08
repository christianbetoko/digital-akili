<div>
     <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
@if($sliders->isNotEmpty() )

@foreach ($sliders as $slider)
    <div class="carousel-item active">
          <img src="{{asset('storage/'. $slider->image)}}" alt="{{$slider->name}}">
          <div class="carousel-container">
            <h2>{{$slider->name}}</h2>
           {!! $slider->description !!}
            <a href="{{$slider->link}}" class="btn-get-started">En savoir plus</a>
          </div>
        </div><!-- End Carousel Item -->
@endforeach



@endif
        

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>

      <div class="featured container">

        <div class="row gy-4">

            <div class="section-header" style="text-align: center; margin-bottom: 10px;">
        
        <p style="color: #555; max-width: 800px; margin: 0 auto;">
            Digital Akili s'appuie sur cinq axes fondamentaux pour transformer l'écosystème numérique en République Démocratique du Congo.
        </p>
    </div>
              @if($caracteristiques->isNotEmpty() )

@foreach ($caracteristiques as $caracteristique)
          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="featured-item position-relative">
              <div class="icon"><i class="{{$caracteristique->icon}}" icon"></i></div>
              <h4><a href="" class="stretched-link">{{$caracteristique->name}}</a></h4>
              <p>{{$caracteristique->description}}</p>
            </div>
          </div><!-- End Featured Item -->
@endforeach
@endif
          

        </div>

      </div>

    </section><!-- /Hero Section -->

     <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Témoignages</h2>
        <p>Ce que disent nos clients sur nos services et solutions</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
@if($testimonials->isNotEmpty() )

@foreach ($testimonials as $testimonial)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-item">
                <img src="{{asset('storage/'. $testimonial->photo)}}" class="testimonial-img" alt="">
                <h3>{{$testimonial->name}}</h3>
                <h4>{{$testimonial->role}}</h4>
                <div class="stars">
                    
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    
                </div>
                <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>{{$testimonial->speech}}</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                </p>
                </div>
            </div><!-- End testimonial item -->
@endforeach


@endif
          

        </div>

      </div>

    </section><!-- /Testimonials Section -->
     <!-- Clients Section -->
    <section id="clients" class="section clients">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Nos Clients</h2>
        <p>Nos clients satisfaits de nos services et solutions</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
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
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            @if($clients->isNotEmpty() )

            @foreach($clients as $client)
            @if($client->logo)
              <div class="swiper-slide" style="text-align:center;"><a href="{{$client->link}}"><img src="{{asset('storage/'. $client->logo)}}" class="img-fluid" alt="{{$client->name}}"></a>
            <br><a href="{{$client->link}}"><span>{{$client->name}}</span></a>
            </div>
           @else
             <div class="swiper-slide"><a href="{{$client->link}}"><span>{{$client->name}}</span></a></div>
           @endif       
              @endforeach

            @endif
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Clients Section -->
            <!-- /Clients Section -->
</div>
