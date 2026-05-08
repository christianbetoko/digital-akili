<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Portfolio;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
#[Title('Réalisations - Digital Akili')]
class RealisationsPage extends Component
{
     use WithPagination; // 
         protected $paginationTheme = 'bootstrap';
    public function render()
    {
       Carbon::setLocale('fr');
         $paginate=4;
      $portfolios=Portfolio::where('status', true)->orderBy('year', 'DESC')->paginate($paginate);
        return view('livewire.realisations-page', compact('portfolios'));
    }
}
