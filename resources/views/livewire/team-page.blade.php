<div>
   
     <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="current">Equipe</li>
          </ol>
        </nav>
        <h1>Notre équipe</h1>
      </div>
    </div><!-- End Page Title -->

  <!-- Team Section -->
    <section id="team" class="team section">

      <div class="container">

        <div class="row gy-4">
@if($members->isNotEmpty())
@foreach ($members as $member)
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{asset('storage/'. $member->image)}}" class="img-fluid" alt="{{$member->name}}"></div>
              <div class="member-info">
                <h4>{{ $member->name }}</h4>
                <span>{{ $member->role }}</span>
                <p>{{ $member->bio }}</p>
                <div class="social">
                 @if($member->twitter) <a href="{{ $member->twitter }}" target="_blank"><i class="bi bi-twitter-x"></i></a> @endif
                 @if($member->facebook) <a href="{{ $member->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a> @endif
                 @if($member->instagram) <a href="{{ $member->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a> @endif
                 @if($member->linkedin) <a href="{{ $member->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a> @endif
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->
@endforeach
@endif
         

        </div>

      </div>

    </section><!-- /Team Section -->


</div>
