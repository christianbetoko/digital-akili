<div>
    <!-- Blog Comments Section -->
    <section id="blog-comments" class="blog-comments section">
        <div class="container">

            <h4 class="comments-count">{{ $comments->count() }} Commentaires</h4>

            @foreach($comments as $comment)
                <div id="comment-{{ $comment->id }}" class="comment">
                    <div class="d-flex">
                        <div class="comment-img">
                            {{-- Génération d'un avatar par défaut basé sur le nom ou image statique --}}
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user_name) }}&background=random" alt="{{ $comment->user_name }}">
                        </div>
                        <div>
                            <h5>
                                <a href="javascript:void(0);">{{ $comment->user_name }}</a> 
                                {{-- <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a> --}}
                            </h5>
                            <time datetime="{{ $comment->created_at }}">{{ $comment->created_at->translatedFormat('d M, Y') }}</time>
                            <p>
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>
                </div><!-- End comment #{{ $comment->id }} -->
            @endforeach

            @if($comments->isEmpty())
                <p class="text-muted">Soyez le premier à laisser un commentaire.</p>
            @endif

        </div>
    </section><!-- /Blog Comments Section -->

    <!-- Comment Form Section -->
    <section id="comment-form" class="comment-form section">
        <div class="container">

            {{-- Utilisation de wire:submit.prevent pour éviter le rechargement de page --}}
            <form wire:submit.prevent="postComment">
                <h4>Laisser un commentaire</h4>
                <p>Votre adresse e-mail ne sera pas publiée. Les champs obligatoires sont marqués d'un *</p>
                
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Votre Nom*">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Votre Email*">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <textarea wire:model="content" class="form-control @error('content') is-invalid @enderror" placeholder="Votre Commentaire*" rows="5"></textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Envoyer le commentaire</span>
                        <span wire:loading><i class="fa fa-spinner fa-spin"></i> Envoi en cours...</span>
                    </button>
                </div>

            </form>

        </div>
    </section><!-- /Comment Form Section -->
</div>