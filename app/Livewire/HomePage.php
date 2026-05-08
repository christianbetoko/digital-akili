<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Slider;
use App\Models\Caracteristique;
use App\Models\Testimonial;
use App\Models\Client;
use Carbon\Carbon;
use Livewire\Attributes\Title;
#[Title('Accueil - Digital Akili')]
class HomePage extends Component
{
    public function render()
    {
            Carbon::setLocale('fr');
            $sliders=Slider::where('status', true)->get();
            $caracteristiques=Caracteristique::where('status', true)->get();
            $clients = Client::where('status', true)->get();
            $testimonials = Testimonial::where('status', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('livewire.home-page', compact('sliders', 'caracteristiques', 'testimonials', 'clients'));
    }
}
