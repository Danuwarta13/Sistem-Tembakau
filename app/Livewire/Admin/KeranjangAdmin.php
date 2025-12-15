<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

class KeranjangAdmin extends Component
{
    #[Title('Keranjang Admin')]
    public function render()
    {
        return view('livewire.admin.keranjang-admin')->layout('layouts.admin');
    }
}