<?php

namespace App\Livewire\Component;

use App\Models\Barangs;
use Livewire\Component;

class DashboardGradeC extends Component
{
    public $totalC;
    public $totalKg;
    public $totalR;
    public $rataR;

    public function mount()
    {
        $this->totalC = Barangs::where('grade', 'C')->count();
        $this->totalKg = Barangs::where('grade', 'C')->sum('netto');
        $this->totalR = Barangs::where('grade', 'C')->sum('jumlah');
        $this->rataR = safe_divide($this->totalR, $this->totalKg);
    }
    public function render()
    {
        return view('livewire.component.dashboard-grade-c');
    }
}
