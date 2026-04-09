<?php

namespace App\Livewire\Component;

use Livewire\Component;

class IconCPrinter extends Component
{
    protected $listeners = ['printer-connected' => 'printerConnected'];

    public function printerConnected()
    {
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 2000)
            ->success('Printer berhasil terhubung');
    }

    public function render()
    {
        return view('livewire.component.icon-c-printer');
    }
}
