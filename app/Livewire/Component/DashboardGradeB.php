<?php

namespace App\Livewire\Component;

use App\Models\Barangs;
use Livewire\Component;

class DashboardGradeB extends Component
{
    public $totalB;
    public $totalKg;
    public $totalR;
    public $rataR;

    public function mount()
    {
        $this->totalB = Barangs::where('grade', 'B')->count();
        $this->totalKg = Barangs::where('grade', 'B')->sum('netto');
        $this->totalR = Barangs::where('grade', 'B')->sum('jumlah');
        $this->rataR = safe_divide($this->totalR, $this->totalKg);
    }
    public function render()
    {
        return view('livewire.component.dashboard-grade-b');
    }
}
