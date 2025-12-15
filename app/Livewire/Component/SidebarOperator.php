<?php

namespace App\Livewire\Component;

use Livewire\Component;

class SidebarOperator extends Component
{
    protected $listeners = ['open-sidebar' => 'openSidebar'];

    public $open = false;

    public function openSidebar()
    {
        // dd('terbuka');
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.component.sidebar-operator');
    }
}