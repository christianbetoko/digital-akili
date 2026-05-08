<div>
    <div class="page-title" >
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="current">Contact</li>
                </ol>
            </nav>
            <h1>Contact</h1>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" >

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" >
                        <i class="bi bi-geo-alt"></i>
                        <h3>Adresse</h3>
                        <p>{{ $enterprise->address ?? 'Adresse non configurée' }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" >
                        <i class="bi bi-telephone"></i>
                        <h3>Appelez-nous</h3>
                        <p>{{ $enterprise->phone ?? '+243 ...' }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" >
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>{{ $enterprise->email ?? 'contact@exemple.com' }}</p>
                    </div>
                </div>
            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-6" >
                    {{-- Utilisation de l'iframe de l'entreprise si disponible, sinon défaut --}}
                    @if($enterprise && $enterprise->map_iframe)
                        {!! $enterprise->map_iframe !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.808269784117!2d15.3138393!3d-4.3214221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNCsxOScyNy4xIlMgMTXCsDE4JzQ5LjgiRQ!5e0!3m2!1sfr!2scd!4v1676961268712!5m2!1sfr!2scd" 
                                frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>

                <div class="col-lg-6">
                    {{-- Formulaire lié à Livewire --}}
                    <form wire:submit.prevent="submitForm" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Votre Nom">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Votre Email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12">
                                <input type="text" wire:model="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Sujet">
                                @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12">
                                <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" rows="6" placeholder="Message"></textarea>
                                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12 text-center">
                                {{-- Gestion du feedback de chargement --}}
                                 <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Envoyer le message</span>
                        <span wire:loading><i class="fa fa-spinner fa-spin"></i> Envoi en cours...</span>
                    </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>