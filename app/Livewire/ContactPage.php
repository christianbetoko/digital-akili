<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Enterprise;
use App\Models\Contact;
 use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
#[Title('Contact - Ets Yoba')]

class ContactPage extends Component
{
   //use LivewireAlert; // Utilisation du trait
public $name;
    public $email;
    public $subject;
    public $message;
    public $successMessage;

    protected $rules = [
        'name'    => 'required|min:3',
        'email'   => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];
public function submitForm()
    {
        // 1. Validation des données
        $this->validate();

        // 2. Création en base de données
        // Note : Le modèle Contact enverra l'email automatiquement grâce au static::booted()
        Contact::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        // 3. Notification et réinitialisation
        $this->reset(['name', 'email', 'subject', 'message']);
        // Déclenchement de l'alerte stylisée

         LivewireAlert::title('Message envoyé avec succès')
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
         Carbon::setLocale('fr');
          $enterprise=Enterprise::first();

        return view('livewire.contact-page',[   
            'enterprise'=>$enterprise,
        ]);
    }
}
