@section('title', $post->title . ' | Digital Akili')

@section('meta_tags')
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:image" content="{{ asset('storage/'.$post->image_cover) }}">
    <meta property="og:type" content="article">

    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 160) }}">
    <meta name="twitter:image" content="{{ asset('storage/'.$post->image_cover) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection
<div>
<div>
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('blog') }}">Actualités</a></li>
                    <li class="current text-truncate" style="max-width: 200px;">{{ $post->title }}</li>
                </ol>
            </nav>
            <h1>{{ $post->title }}</h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <section id="blog-details" class="blog-details section">
                    <article class="article shadow-sm p-4 rounded bg-white">

                        <div class="post-img mb-4">
                            <img src="{{ asset('storage/' . $post->image_cover) }}" alt="{{ $post->title }}" class="img-fluid rounded w-100">
                        </div>

                        <h2 class="title mb-3">{{ $post->title }}</h2>

                        <!-- Barre de Meta avec Bouton Partager -->
                        <div class="meta-top d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <ul class="list-unstyled d-flex mb-0">
                                <li class="me-3"><i class="bi bi-clock text-primary"></i> <time datetime="{{ $post->published_at }}">{{ $post->published_at->translatedFormat('d M Y') }}</time></li>
                                <li><i class="bi bi-chat-dots text-primary"></i> {{ $comments->count() }} Commentaires</li>
                            </ul>
                            
                            <div class="share-area">
                                <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm transition-all" 
                                        id="shareBtn"
                                        data-title="{{ $post->title }}" 
                                        data-url="{{ url()->current() }}">
                                    <i class="bi bi-share-fill me-1"></i> Partager
                                </button>
                            </div>
                        </div>

                        <div class="content mt-4 leading-relaxed">
                            {!! $post->content !!}
                        </div>

                    </article>
                </section>

                <!-- Section Commentaires -->
                <div class="mt-5">
                    <livewire:comment-section :postId="$post->id" />
                </div>
            </div>
        </div>
    </div>
</div>
<div>
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