<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\NewslettreSubscribers;
use Carbon\Carbon;
 use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
class Newletter extends Component
{
      public $email;
      protected $rules = [
       
        'email'   => 'required|unique:newslettre_subscribers,email|email',
       
    ];
    public function submitForm()
    {
        // 1. Validation des données
        $this->validate();

        // 2. Création en base de données
        // Note : Le modèle Contact enverra l'email automatiquement grâce au static::booted()
        NewslettreSubscribers::create([
            
            'email'   => $this->email,
           
        ]);

        // 3. Notification et réinitialisation
        $this->reset(['email']);
        // Déclenchement de l'alerte stylisée

         LivewireAlert::title('Merci pour votre abonnement à notre newsletter !')
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
       
       // $this->successMessage = "Votre message a été envoyé avec succès ! Christian vous répondra sous peu.";
    }
    public function render()
    {
        return view('livewire.components.newletter');
    }
}
