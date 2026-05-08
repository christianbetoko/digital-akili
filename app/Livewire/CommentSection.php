<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
class CommentSection extends Component
{
    public $postId;
    public $name;
    public $email;
    public $content;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'content' => 'required|min:5',
    ];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->postId,
            'user_name' => $this->name,
            'user_email' => $this->email,
            'content' => $this->content,
        ]);

        // Réinitialiser les champs après envoi
        $this->reset(['name', 'email', 'content']);
 LivewireAlert::title('Commentaire envoyé avec succès')
        ->success()
        ->withOptions([
            'background' => '#E8F5E9', // Couleur de fond vert très clair (exemple)
            'confirmButtonColor' => '#5900FF', // Couleur du bouton de confirmation (vert, exemple)
            'color' => '#5900FF',
             'customClass' => [
                'popup' => 'custom-success-popup', // Classe pour le conteneur principal de l'alerte
                'icon' => 'custom-success-icon',   // Classe pour l'icône de succès elle-même
            ],
             // Couleur du texte du titre et du message (vert foncé, exemple)
        ])

        ->show();
        // Notification de succès
        //session()->flash('message', 'Votre commentaire a été publié avec succès !');
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => Comment::where('post_id', $this->postId)->where('is_visible', true)->latest()->get()
        ]);
    }
}