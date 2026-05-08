<div>

  <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li class="current">Actualités</li>
          </ol>
        </nav>
        <h1>Actualités</h1>
      </div>
    </div><!-- End Page Title -->


   <div class="container">
    <div class="row">

        <div class="col-lg-8">

            <!-- Blog Posts Section -->
            <section id="blog-posts" class="blog-posts section">
                <div class="container">
                    <div class="row gy-4">

                        @forelse($posts as $post)
                        <div class="col-lg-12">
                            <article>
                                <div class="post-img">
                                    {{-- Utilisation de l'image du post ou une image par défaut --}}
                                    <img src="{{ $post->image_cover ? asset('storage/' . $post->image_cover) : asset('assets/img/blog/blog-1.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                                </div>

                                <h2 class="title">
                                    <a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a>
                                </h2>

                                <div class="meta-top">
                                    <ul>
                                       
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                                            <a href="#"><time datetime="{{ $post->published_at }}">{{ $post->published_at->translatedFormat('d M, Y') }}</time></a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> 
                                            <a href="#">{{ $post->comments()->count() ?? 0 }} Commentaires</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="content">
                                    <p>
                                        {{ Str::limit(strip_tags($post->content), 200) }}
                                    </p>

                                    <div class="read-more">
                                        <a href="{{ route('blog.single', $post->slug) }}">Lire la suite</a>
                                    </div>
                                </div>

                            </article>
                        </div><!-- End post list item -->
                        @empty
                        <div class="col-12 text-center py-5">
                            <p>Aucun article trouvé pour cette recherche ou catégorie.</p>
                        </div>
                        @endforelse

                    </div><!-- End blog posts list -->
                </div>
            </section><!-- /Blog Posts Section -->

            <!-- Blog Pagination Section -->
            <section id="blog-pagination" class="blog-pagination section">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        {{-- Utilisation du lien de pagination natif de Livewire --}}
                        {{ $posts->links() }}
                    </div>
                </div>
            </section><!-- /Blog Pagination Section -->

        </div>

        <div class="col-lg-4 sidebar">
            <div class="widgets-container">

                <!-- Search Widget -->
                <div class="search-widget widget-item">
                    <h3 class="widget-title">Rechercher</h3>
                    {{-- Liaison avec searchTerm --}}
                    <form action="javascript:void(0);">
                        <input type="text" wire:model.live.debounce.300ms="searchTerm" placeholder="Taper un titre...">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div><!--/Search Widget -->

                <!-- Categories Widget -->
                <div class="categories-widget widget-item">
                    <h3 class="widget-title">Catégories</h3>
                    <ul class="mt-3">
                        @foreach($categories as $category)
                        <li>
                            <div class="form-check">
                                {{-- Filtrage par checkbox lié à selected_category --}}
                                <input class="form-check-input" type="checkbox" 
                                       value="{{ $category->id }}" 
                                       wire:model.live="selected_category" 
                                       id="cat-{{ $category->id }}">
                                <label class="form-check-label w-100 d-flex justify-content-between" for="cat-{{ $category->id }}">
                                    {{ $category->name }} <span>({{ $category->posts->count() }})</span>
                                </label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div><!--/Categories Widget -->

                <!-- Recent Posts Widget -->
                <div class="recent-posts-widget widget-item">
                    <h3 class="widget-title">Articles récents</h3>
                    @foreach($recent_posts as $recent)
                    <div class="post-item">
                        <img src="{{ $recent->image_cover ? asset('storage/' . $recent->image_cover) : asset('assets/img/blog/blog-recent-1.jpg') }}" alt="" class="flex-shrink-0">
                        <div>
                            <h4><a href="{{ route('blog.single', $recent->slug) }}">{{ $recent->title }}</a></h4>
                            <time datetime="{{ $recent->published_at }}">{{ $recent->published_at->translatedFormat('d M, Y') }}</time>
                        </div>
                    </div><!-- End recent post item-->
                    @endforeach
                </div><!--/Recent Posts Widget -->

            </div>
        </div>

    </div>
   </div>
</div>
</div>
