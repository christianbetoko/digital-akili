<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Member;
use Carbon\Carbon;
#[Title('Equipe - Digital Akili')]
class TeamPage extends Component
{
    public function render()
    {
            Carbon::setLocale('fr');
        $members = Member::where('status', true)->get();
        return view('livewire.team-page', compact('members'));
    }
}
