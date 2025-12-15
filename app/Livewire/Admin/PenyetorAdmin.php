<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

class PenyetorAdmin extends Component
{
    #[Title('Penyetor Admin')]
    public function render()
    {
        return view('livewire.admin.penyetor-admin')->layout('layouts.admin');
    }
}