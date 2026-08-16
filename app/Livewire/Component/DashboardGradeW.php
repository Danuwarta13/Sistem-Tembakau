<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Barangs;

class DashboardGradeW extends Component
{
    public $totalC;
    public $totalKg;
    public $totalR;
    public $rataR;

    public function mount()
    {
        $this->totalC = Barangs::where('grade', 'W')->count();
        $this->totalKg = Barangs::where('grade', 'W')->sum('netto');
        $this->totalR = Barangs::where('grade', 'W')->sum('jumlah');
        $this->rataR = safe_divide($this->totalR, $this->totalKg);
    }
    public function render()
    {
        return view('livewire.component.dashboard-grade-w');
    }
}