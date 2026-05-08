<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Portfolio;
use Carbon\Carbon;
use Livewire\Attributes\Title;
#[Title('Realisation - Digital Akili')]
class SingleRealisationPage extends Component
{
        public $slug;
          public function mount( $slug){
       
        $this->slug = $slug;
    }   

    public function render()
    {
         Carbon::setLocale('fr');
         $portfolio=Portfolio::where('slug', $this->slug)->firstOrFail();
        return view('livewire.single-realisation-page', compact('portfolio'));
    }
}
