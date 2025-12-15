<?php

namespace App\Livewire\Component;

use Livewire\Component;

class IconFullscreen extends Component
{
    public function toggleFullscreen()
    {
        $this->dispatch('fullscreen-toggle');
    }

    public function render()
    {
        return view('livewire.component.icon-fullscreen');
    }
}
