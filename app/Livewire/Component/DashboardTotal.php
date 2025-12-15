<?php

namespace App\Livewire\Component;

use App\Models\Barangs;
use Livewire\Component;

class DashboardTotal extends Component
{
    public $totalKrj;
    public $totalKg;
    public $totalR;
    public $rataR;

    public function mount()
    {
        $this->totalKrj = Barangs::count();
        $this->totalKg = Barangs::sum('netto');
        $this->totalR = Barangs::sum('jumlah');
        $this->rataR = safe_divide($this->totalR, $this->totalKg);
    }

    public function render()
    {
        return view('livewire.component.dashboard-total');
    }
}
