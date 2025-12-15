<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Livewire\Attributes\Title;

class Dashboard extends Component
{

    #[Title('Dashboard Operator')]
    public function render()
    {
        return view('livewire.operator.dashboard')->layout('layouts.operator');
    }
}