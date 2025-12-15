<?php

namespace App\Livewire\Component;

use Livewire\Component;

class SidebarAdmin extends Component
{
    protected $listeners = ['open-sidebar' => 'openSidebar'];

    public $open = false;

    public function openSidebar()
    {
        // dd('buka');
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.component.sidebar-admin');
    }
}