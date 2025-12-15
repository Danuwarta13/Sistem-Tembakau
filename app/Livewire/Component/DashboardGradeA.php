<?php

namespace App\Livewire\Component;

use App\Models\Barangs;
use Livewire\Component;

class DashboardGradeA extends Component
{
    public $totalA;
    public $totalKg;
    public $totalR;
    public $rataR;

    public function mount()
    {
        $this->totalA = Barangs::where('grade', 'A')->count();
        $this->totalKg = Barangs::where('grade', 'A')->sum('netto');
        $this->totalR = Barangs::where('grade', 'A')->sum('jumlah');
        $this->rataR = safe_divide($this->totalR, $this->totalKg);
    }

    public function render()
    {
        return view('livewire.component.dashboard-grade-a');
    }
}
