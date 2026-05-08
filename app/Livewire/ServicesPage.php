<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Service;
use Carbon\Carbon;
#[Title('Services - Digital Akili')]
class ServicesPage extends Component
{
    public function render()
    {
        Carbon::setLocale('fr');
         $services=Service::where('status', true)->get();
        return view('livewire.services-page', compact('services'));
    }
}
