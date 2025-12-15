<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Livewire\Attributes\Title;

class PenyetorOperator extends Component
{
    #[Title('Penyetor Operator')]
    public function render()
    {
        return view('livewire.operator.penyetor-operator')->layout('layouts.operator');
    }
}