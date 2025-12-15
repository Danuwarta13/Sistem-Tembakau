<?php

namespace App\Livewire\Component;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $theme = 'light';

    public function mount()
    {
        // Ambil preferensi user dari sistem
        $this->theme = session('theme', 'light');
    }

    public function toggle()
    {
        $this->theme = $this->theme === 'dark' ? 'light' : 'dark';

        session(['theme' => $this->theme]);

        // Emit ke frontend agar class dark/lgiht berubah
        $this->dispatch('theme-changed', theme: $this->theme);
    }

    public function render()
    {
        return view('livewire.component.theme-toggle');
    }
}
