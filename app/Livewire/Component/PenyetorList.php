<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PenyetorList extends Component
{

    use WithPagination;

    #[On('penyetor-created')]
    #[On('updated-penyetor')]
    public function refreshPenyetorList()
    {
        // This method will be called when a penyetor is created or updated
        $this->resetPage();
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }


    public $query = '';

    #[Computed()]
    public function penyetors()
    {
        return Pelanggans::withCount('barangs')
            ->withSum('barangs as total_kg', 'netto')
            ->withSum('barangs as total_cash', 'jumlah')
            ->when($this->query, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('nama', 'like', '%' . $this->query . '%')
                        ->orWhere('daerah', 'like', '%' . $this->query . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    public function edit($id)
    {
        // dd($id);
        $this->dispatch('openEditPenyetorModal', id: $id);
    }

    public function render()
    {
        return view('livewire.component.penyetor-list', [
            'penyetors' => $this->penyetors
        ]);
    }
}
