<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Enterprise;
use App\Models\Stat;
use Carbon\Carbon;
use Livewire\Attributes\Title;
#[Title('A propos - Digital Akili')]
class AboutPage extends Component
{
    public function render()
    {
            Carbon::setLocale('fr');
            $enterprise=Enterprise::first();
            $stats=Stat::where('status', true)->get();
        return view('livewire.about-page', compact('enterprise','stats'));
    }
}
