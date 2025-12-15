<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Livewire\Attributes\Title;

class KeranjangOperator extends Component
{
    #[Title('Keranjang Operator')]
    public function render()
    {
        return view('livewire.operator.keranjang-operator')->layout('layouts.operator');
    }
}