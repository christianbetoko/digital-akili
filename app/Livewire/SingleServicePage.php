<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Attributes\Title;
#[Title('Service - Digital Akili')]
class SingleServicePage extends Component
{
      public $slug;



    public function mount( $slug){
       
        $this->slug = $slug;
    }   
    public function render()
    {
        Carbon::setLocale('fr');
         $service=Service::where('slug', $this->slug)->firstOrFail();
        return view('livewire.single-service-page', compact('service'));
    }
}
