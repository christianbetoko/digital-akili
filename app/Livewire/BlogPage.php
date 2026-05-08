<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\Comment;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
#[Title('Actualités - Digital Akili')]
class BlogPage extends Component
{
    use WithPagination; // 2. Utiliser le trait
    // 3. Définir le thème sur Bootstrap
    protected $paginationTheme = 'bootstrap';
    #[Url]
    public $selected_category = [];
     #[Url]
     public $searchTerm = '';
    public function render()
    {
        Carbon::setLocale('fr');
         $paginate=4;
         $recent_posts=Post::orderBy('published_at','DESC')->where('status','published')
        ->limit(5) 
        ->get();
        $categories = Category::whereHas('posts', function ($query) { $query->where('status', 'published') ; })->get();
        if(!empty($this->searchTerm))
        {
             $posts=Post::orderBy('published_at','DESC')->where('status','published')
            ->where('title','like','%'.$this->searchTerm.'%')
            
            ->paginate($paginate);
        }
        elseif(!empty($this->selected_category))
        {
             $posts=Post::orderBy('published_at','DESC')->where('status','published')
            ->whereIn('category_id',$this->selected_category)
            
            ->paginate($paginate);
        }
        else{
             $posts=Post::orderBy('published_at','DESC')->where('status','published')->paginate($paginate);
        }
        
        $comments=Comment::where('is_visible',true)->get();
        return view('livewire.blog-page', compact('posts', 'recent_posts', 'categories', 'comments'));
    }
}
